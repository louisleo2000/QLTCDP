import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { AuthConstants } from '../config/auth-constants';
import { AuthService } from './../Services/auth.service';
import { StorageService } from './../Services/storage.service';
import { AlertAndLoadingService } from './../Services/alert-and-loading.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  loginForm: FormGroup;
  email: FormControl;
  password: FormControl;
  showPass = false;
  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private authService: AuthService,
    private storageService: StorageService,
    private alertAndLoading: AlertAndLoadingService,
  ) {

    this.email = new FormControl('',
      [
        Validators.required,
        Validators.pattern("^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$")
      ]);

    this.password = new FormControl('',
      [
        Validators.required,
        Validators.minLength(8)
      ]);

    this.loginForm = formBuilder.group({
      email: this.email,
      password: this.password
    });
  }
  ngOnInit() {
  }
  toggleFieldTextType() {
     this.showPass = !this.showPass;
  }


  onSubmit() {
    let data = this.loginForm.value
    this.alertAndLoading.presentLoading()
    this.authService.login(data)
  }
}
