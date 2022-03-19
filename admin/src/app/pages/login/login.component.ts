import { AlertAndLoadingService } from './../../Services/alert-and-loading.service';
import { Router } from '@angular/router';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit, OnDestroy {
  loginForm: FormGroup;
  email: FormControl;
  password: FormControl;
  fieldTextType = false
  constructor( private formBuilder: FormBuilder,public router: Router, private alerAndLoadingService: AlertAndLoadingService) {
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
  ngOnDestroy() {
  }
  onSubmit() {
    this.alerAndLoadingService.presentLoading()
    if(this.email.value == "admin@gmail.com" && this.password.value == "admin123"){
      this.router.navigate(['/home']);
    }
    else
    {
      alert("Invalid Credentials");
    }
  }
  toggleFieldTextType() {
    this.fieldTextType = !this.fieldTextType;
  }
}
