import { Component, OnInit } from '@angular/core';
import {
  FormGroup,
  FormControl,
  FormBuilder,
  Validators,
} from '@angular/forms';
import { Router } from '@angular/router';
import { AuthConstants } from '../config/auth-constants';
import { AlertAndLoadingService } from '../Services/alert-and-loading.service';
import { AuthService } from '../Services/auth.service';
import { StorageService } from '../Services/storage.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage implements OnInit {
  signupForm: FormGroup;
  email: FormControl;
  password: FormControl;
  password_confirmation: FormControl;
  name: FormControl;
  // tel:FormControl
  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private storageService: StorageService,
    private alertAndLoading: AlertAndLoadingService
  ) {
    this.email = new FormControl('', [
      Validators.required,
      Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$'),
    ]);
    this.password = new FormControl('', [
      Validators.required,
      Validators.minLength(8),
    ]);
    this.password_confirmation = new FormControl('', [
      Validators.required,
      Validators.minLength(8),
    ]);
    this.name = new FormControl('', [
      Validators.required,
      Validators.minLength(2),
      Validators.pattern(/[\S]/)
    ]);
    // this.tel = new FormControl('',
    // [
    //   Validators.required,
    //   Validators.pattern("^0[0-9]{9,10}$")
    // ]);
    this.signupForm = formBuilder.group(
      {
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        name: this.name,
        // tel:this.tel
      },
      {
        validator: this.ConfirmedValidator('password', 'password_confirmation'),
      }
    );
  }


  ConfirmedValidator(controlName: string, matchingControlName: string) {
    return (formGroup: FormGroup) => {
      const control = formGroup.controls[controlName];
      const matchingControl = formGroup.controls[matchingControlName];
      if (
        matchingControl.errors &&
        !matchingControl.errors.confirmedValidator
      ) {
        return;
      }
      if (control.value !== matchingControl.value) {
        matchingControl.setErrors({ confirmedValidator: true });
      } else {
        matchingControl.setErrors(null);
      }
    };
  }

  ngOnInit() {
  }

  onChange($event:any) {
    $event.target.value = $event.target.value.trim();
    
  }

  onSubmit() {
    let data = this.signupForm.value;
    this.alertAndLoading.presentLoading();
    this.authService.signUp(data).subscribe(
      (res) => {
        if (res.success) {
          this.alertAndLoading.presentAlert('Đăng ký thành công');
          this.storageService.store(AuthConstants.AUTH, res.success);
          this.router.navigate(['tabs']);
          this.alertAndLoading.dismissLoadling();
        } else {
          console.log('Email đã có người sử dụng');
          this.alertAndLoading.dismissLoadling();
          this.alertAndLoading.presentAlert('Email đã có người sử dụng');
        }
      },
      (error) => {
        if (error.status == 500 || error.status == 0) {
          console.log('Không thể kết nối đến server');
          this.alertAndLoading.dismissLoadling();
          this.alertAndLoading.presentAlert(
            'Không thể kết nối đến server.Hãy kiểm tra lại kết nối của bạn!'
          );
        } else if (error.status == 422) {
          this.alertAndLoading.dismissLoadling();
          console.log('Email đã có người sử dụng');
          this.alertAndLoading.presentAlert('Email đã có người sử dụng');
        } else {
          this.alertAndLoading.dismissLoadling();
          console.log(error);
          this.alertAndLoading.presentAlert(error.message);
        }
      }
    );
  }
}
