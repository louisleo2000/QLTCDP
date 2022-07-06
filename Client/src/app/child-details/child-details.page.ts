import { Component, OnInit } from '@angular/core';
import {
  FormGroup,
  FormControl,
  FormBuilder,
  Validators,
} from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { format, parseISO } from 'date-fns';
import * as moment from 'moment';
import { AlertAndLoadingService } from '../Services/alert-and-loading.service';
import { AuthService } from './../Services/auth.service';

@Component({
  selector: 'app-child-details',
  templateUrl: './child-details.page.html',
  styleUrls: ['./child-details.page.scss'],
})
export class ChildDetailsPage {
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
  now = format(new Date(), 'yyyy-MM-dd');
  pickdate = {
    short: format(new Date(), 'dd-MM-yyyy'),
    full: format(new Date(), 'yyyy-MM-dd') + 'T09:00:00.000Z',
  };
  enMsg = {
    name: [
      { type: 'required', message: 'Họ và tên không được trống' },
      { type: 'minlength', message: 'Họ và tên phải có ít nhất 2 ký tự' },
      { type: 'maxlength', message: 'Họ và tên không được quá 70 ký tự' },
      {
        type: 'pattern',
        message: 'Họ và tên không được chứa số hoặc ký tự đặc biệt',
      },
    ],
    health_nsurance_id: [
      { type: 'required', message: 'Số bảo hiểm y tế không được trống' },
      {
        type: 'minlength',
        message: 'Số bảo hiểm y tế phải có ít nhất 15 ký tự',
      },
      {
        type: 'maxlength',
        message: 'Số bảo hiểm y tế không được quá 15 ký tự',
      },
      { type: 'pattern', message: 'Số bảo hiểm y tế không đúng định dạng' },
    ],
    // img: [{ type: 'required', message: 'Bạn chưa chọn ảnh' }],
    gender: [{ type: 'required', message: 'Giới tính không được trống' }],
    dob: [{ type: 'required', message: 'Bạn chưa chọn ngày sinh' }],
    weight: [
      { type: 'required', message: 'Cân nặng không được trống' },
      { type: 'max', message: 'Cân nặng trẻ không được lớn hơn 200kg' },
      { type: 'min', message: 'Cân nặng trẻ phải trên 0kg' },
    ],
    height: [
      { type: 'required', message: 'Chiều cao không được trống' },
      { type: 'max', message: 'Chiều cao trẻ không được lớn hơn 300cm' },
      { type: 'min', message: 'Chiều cao trẻ phải trên 0cm' },
    ],
    passport_expiry_date: [
      { type: 'required', message: 'Please select passport expiry date' },
    ],
    club_id: [{ type: 'required', message: 'Please select club' }],
  };

  id: number;
  currentChild;
  searchText;
  isHistoryOpen: boolean = false;
  isModalOpen: boolean = false;
  constructor(
    private route: ActivatedRoute,
    private authService: AuthService,
    private formBuilder: FormBuilder,
    private alertAndLoading: AlertAndLoadingService,
    private router: Router
  ) {
    this.id = this.route.snapshot.params.id;
    this.currentChild = authService.childs.value.find((e) => {
      if (e.id == this.id) {
        // console.log(e.vaccination_details);
        const counts = {};
        e.vaccination_details.forEach(function (x) {
          if (counts[x.vaccine.id] == undefined) {
            counts[x.vaccine.id] = { number: [], name: '' };
          }
          counts[x.vaccine.id] = {
            // number: (counts[x.vaccine.id].number || 0) + 1,
            name: x.vaccine.name,
            number: counts[x.vaccine.id].number.concat([
              counts[x.vaccine.id].number.length + 1,
            ]),
          };
        });
        // console.log(counts);
        e.counts = [];
        for (var i in counts) e.counts.push(counts[i]);
        // console.log(e);
      }
      return e.id == this.id;
    });

    this.buildForm();
  }

  // ngOnInit() {
  //   //format dob to dd/mm/yyyy and set to pickdate.short

  //   this.pickdate.short =  this.currentChild.dob
  //   this.imageUrl = this.currentChild.img;
  //   // this.pickdate.full = this.currentChild.dob + 'T09:00:00.000Z';

  // }
  //close modal
  closeModal() {
    this.isModalOpen = false;
    this.buildForm();
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

    console.log(this.currentChild.dob);
    filedata.append('child_id', this.currentChild.id);
    filedata.append('name', this.addChildForm.value.name);
    //check if image is selected
    if (this.selectedImage) {
      filedata.append('img', this.selectedImage, this.img.value);
    }
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
      .editchild(filedata, this.authService.currentToken.getValue())
      .subscribe(
        (res) => {
          if (res.success) {
            this.alertAndLoading.dismissLoadling();
            //reload formcontrol
            this.addChildForm.reset();
            this.isModalOpen = false;
            // this.alertAndLoading.presentAlert('Sửa thành công');
            setTimeout(() => {
              this.router.navigate(['/tabs']);
              window.location.reload();
            }, 1000);
          } else {
            console.log(res);
            this.alertAndLoading.dismissLoadling();
            this.alertAndLoading.presentAlert('Sửa không thành công');
          }
        },
        (error) => {
          this.alertAndLoading.dismissLoadling();
          let mess = error.error.message;
          switch (error.status) {
            case 400:
              mess = error.error.message;
              break;
            case 401:
              mess = 'Phiên đăng nhập hết hạn.Vui lòng đăng nhập lại';
              this.authService.logOut();
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

  //build form
  buildForm() {
    this.name = new FormControl(this.currentChild.name, [
      Validators.required,
      Validators.minLength(2),
      Validators.maxLength(70),
      Validators.pattern(/[\S]/),
      Validators.pattern(
        /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/
      ),
    ]);

    this.gender = new FormControl(this.currentChild.gender, [
      Validators.required,
    ]);

    this.img = new FormControl(this.currentChild.img, [Validators.required]);

    this.weight = new FormControl(this.currentChild.weight, [
      Validators.required,
      Validators.max(200),
      Validators.min(0.01),
    ]);

    this.height = new FormControl(this.currentChild.height, [
      Validators.required,
      Validators.max(300),
      Validators.min(0.01),
    ]);

    this.dob = new FormControl(this.currentChild.dob, [Validators.required]);
    this.health_nsurance_id = new FormControl(
      this.currentChild.health_nsurance_id,
      [
        Validators.required,
        Validators.minLength(15),
        Validators.maxLength(15),
        Validators.pattern(/^[A-Z]{2}\d{13}$/),
      ]
    );

    this.addChildForm = this.formBuilder.group({
      name: this.name,
      gender: this.gender,
      img: this.img,
      weight: this.weight,
      height: this.height,
      dob: this.dob,
      health_nsurance_id: this.health_nsurance_id,
    });

    this.imageUrl = this.currentChild.img;
    this.pickdate.short = this.currentChild.dob;
    //convert date currentChild.dob to yyyy-mm-dd
    var momentVariable = moment(this.currentChild.dob, 'DD/MM/YYYY');
    this.dob.setValue(momentVariable.format('YYYY-MM-DD'));
  }
}
