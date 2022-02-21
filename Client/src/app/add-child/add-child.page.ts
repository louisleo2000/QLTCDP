import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators, FormBuilder } from '@angular/forms';
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
  exten:string
  selectedImage: any
  imageUrl:string
  addChildForm: FormGroup;
  name: FormControl;
  gender: FormControl;
  img: FormControl;
  weight: FormControl;
  height: FormControl;
  birthday: FormControl;
  pickdate = {
    'short':format(new Date(), 'dd-MM-yyyy') ,
    'full' :format(new Date(), 'yyyy-MM-dd') + 'T09:00:00.000Z'
  }

  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private alertAndLoading: AlertAndLoadingService,
    private router: Router) {
    this.name = new FormControl('',
      [
        Validators.required,
        Validators.minLength(2)
      ]);

    this.gender = new FormControl('nam',
      [
        Validators.required,
      ]);

    this.img = new FormControl('',
      [
        Validators.required,
      ]);

    this.weight = new FormControl('',
      [
        Validators.required,
      ]);

    this.height = new FormControl('',
      [
        Validators.required,
      ]);

    this.birthday = new FormControl(format(new Date(), 'yyyy-MM-dd'),
      [
        Validators.required,
      ]);

    this.addChildForm = formBuilder.group({
      name: this.name,
      gender: this.gender,
      img: this.img,
      weight: this.weight,
      height: this.height,
      birthday: this.birthday,
    });
  }

  ngOnInit() {
  }
  dataChange(value) {
    this.pickdate.short = format(parseISO(value), 'dd-MM-yyyy')
    this.pickdate.full = value
    this.birthday.setValue(format(parseISO(value), 'yyyy-MM-dd'))
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
    let now = new Date()
    this.img.setValue(this.birthday.value + now.getTime()+"."+this.exten)
    console.log(this.img.value)
  }

  onSubmit() {
    let now = new Date()
    this.img.setValue(this.birthday.value + now.getTime()+"."+this.exten)
    let data = this.addChildForm.value
    this.alertAndLoading.presentLoading()
    this.authService.addchild(data).subscribe(res => {
      if (res.success) {
        this.alertAndLoading.dismissLoadling()
        this.alertAndLoading.presentAlert('Thêm thành công')
        this.router.navigate(['/tabs'])
      }
      else {
        console.log('Thêm không thành công')
        this.alertAndLoading.dismissLoadling()
        this.alertAndLoading.presentAlert('Thêm không thành công')

      }

    },
      (error) => {

        if (error.status == 500 || error.status == 0) {
          console.log("Không thể kết nối đến server")
          this.alertAndLoading.dismissLoadling()
          this.alertAndLoading.presentAlert("Không thể kết nối đến server.Hãy kiểm tra lại kết nối của bạn!");
        }
        else {
          this.alertAndLoading.dismissLoadling()
          console.log(error)
          this.alertAndLoading.presentAlert(error.message)
        }

      }
    )
  }

}
