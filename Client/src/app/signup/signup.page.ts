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
  fieldTextType = {
    pass: false,
    repass: false,
  };
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

  toggleFieldTextType(i) {
    if (i == 1) {
      this.fieldTextType.pass = !this.fieldTextType.pass;
    } else this.fieldTextType.repass = !this.fieldTextType.repass;
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
    data.role = 3;
    this.alertAndLoading.presentLoading();
    this.authService.signUp(data).subscribe(
      (res) => {
        if (res.success) {
          this.alertAndLoading.presentAlert('????ng k?? th??nh c??ng');
          //reset form
          this.signupForm.reset();
          this.storageService.store(AuthConstants.AUTH, res.success);
          this.router.navigate(['tabs']);
          this.alertAndLoading.dismissLoadling();
        } else {
          console.log('Email ???? c?? ng?????i s??? d???ng');
          this.alertAndLoading.dismissLoadling();
          this.alertAndLoading.presentAlert('Email ???? c?? ng?????i s??? d???ng');
        }
      },
      (error) => {
        if (error.status == 500 || error.status == 0) {
          console.log('Kh??ng th??? k???t n???i ?????n server');
          this.alertAndLoading.dismissLoadling();
          this.alertAndLoading.presentAlert(
            'Kh??ng th??? k???t n???i ?????n server.H??y ki???m tra l???i k???t n???i c???a b???n!'
          );
        } else if (error.status == 422) {
          this.alertAndLoading.dismissLoadling();
          console.log('Email ???? c?? ng?????i s??? d???ng');
          this.alertAndLoading.presentAlert('Email ???? c?? ng?????i s??? d???ng');
        } else {
          this.alertAndLoading.dismissLoadling();
          console.log(error);
          this.alertAndLoading.presentAlert(error.message);
        }
      }
    );
  }
}
