import { Component, OnInit } from '@angular/core';
import {
  FormGroup,
  FormControl,
  Validators,
  FormBuilder,
} from '@angular/forms';
import { format, parseISO } from 'date-fns';
import { AuthService } from './../Services/auth.service';
import { AlertAndLoadingService } from './../Services/alert-and-loading.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-child',
  templateUrl: './add-child.page.html',
  styleUrls: ['./add-child.page.scss'],
})
export class AddChildPage implements OnInit {
  exten: string;
  selectedImage: any;
  imageUrl: string;
  addChildForm: FormGroup;
  name: FormControl;
  gender: FormControl;
  img: FormControl;
  weight: FormControl;
  height: FormControl;
  dob: FormControl;
  health_nsurance_id: FormControl;
  pickdate = {
    short: format(new Date(), 'dd-MM-yyyy'),
    full: format(new Date(), 'yyyy-MM-dd') + 'T09:00:00.000Z',
  };

  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private alertAndLoading: AlertAndLoadingService,
    private router: Router
  ) {
    this.name = new FormControl('', [
      Validators.required,
      Validators.minLength(2),
      Validators.pattern(/[\S]/),
    ]);

    this.gender = new FormControl('nam', [Validators.required]);

    this.img = new FormControl('', [Validators.required]);

    this.weight = new FormControl('', [Validators.required,Validators.max(200),Validators.min(0)]);

    this.height = new FormControl('', [Validators.required,Validators.max(200),Validators.min(10)]);

    this.dob = new FormControl(format(new Date(), 'yyyy-MM-dd'), [
      Validators.required,
    ]);
    this.health_nsurance_id = new FormControl('', [
      Validators.required,
      Validators.minLength(15),
      Validators.maxLength(15),
      Validators.pattern(/^[A-Z]{2}\d{13}$/),
    ]);

    this.addChildForm = formBuilder.group({
      name: this.name,
      gender: this.gender,
      img: this.img,
      weight: this.weight,
      height: this.height,
      dob: this.dob,
      health_nsurance_id: this.health_nsurance_id,
    });
  }

  ngOnInit() {
    if (this.authService.userData.value == null) {
      this.router.navigate(['/tabs']);
    }
  }
  dataChange(value) {
    this.pickdate.short = format(parseISO(value), 'dd-MM-yyyy');
    this.pickdate.full = value;
    this.dob.setValue(format(parseISO(value), 'yyyy-MM-dd'));
  }

  onChange($event: any) {
    $event.target.value = $event.target.value.trim();
    //change to array by spcae
    let arr = $event.target.value.split(' ');
    //capitalize the first letter in array
    arr = arr.map((item) => {
      return item.charAt(0).toUpperCase() + item.slice(1);
    });
    //join array to string
    $event.target.value = arr.join(' ');
    
    
  }

  onImageSelected(event) {
    console.log(event);
    this.selectedImage = event.target.files[0];
    let reader = new FileReader();
    this.exten = event.target.files[0].name.split('.').pop();
    reader.onload = (e: any) => {
      this.imageUrl = e.target.result;
    };
    reader.readAsDataURL(this.selectedImage);
    let now = new Date();
    this.img.setValue(this.dob.value + now.getTime() + '.' + this.exten);
    // console.log(this.img.value)
  }

  onSubmit() {
    let now = new Date();
    this.img.setValue(this.dob.value + now.getTime() + '.' + this.exten);
    let filedata = new FormData();
    filedata.append('name', this.addChildForm.value.name);
    filedata.append('img', this.selectedImage, this.img.value);
    filedata.append('gender', this.addChildForm.value.gender);
    filedata.append('weight', this.addChildForm.value.weight);
    filedata.append('height', this.addChildForm.value.height);
    filedata.append('dob', this.addChildForm.value.dob);
    filedata.append(
      'health_nsurance_id',
      this.addChildForm.value.health_nsurance_id
    );

    this.alertAndLoading.presentLoading();
    this.authService
      .addchild(filedata, this.authService.currentToken.getValue())
      .subscribe(
        (res) => {
          if (res.success) {
            this.alertAndLoading.dismissLoadling();
            this.alertAndLoading.presentAlert('Thêm thành công');
            //reload formcontrol
            this.addChildForm.reset();
            this.router.navigate(['/tabs']);
          } else {
            console.log('Thêm không thành công');
            this.alertAndLoading.dismissLoadling();
            this.alertAndLoading.presentAlert('Thêm không thành công');
          }
        },
        (error) => {
          this.alertAndLoading.dismissLoadling();
          let mess = error.error.message;
          switch (error.status) {
            case 400:
              mess = 'Thông tin thành viên này đã tồn tại trong hệ thống';
              break;
            case 500:
            case 0:
              mess = 'Không thể kết nối đến server';
              break;
            default:
              mess = error.error.message;
              break;
          }
          this.alertAndLoading.presentAlert(mess);
        }
      );
  }
}
