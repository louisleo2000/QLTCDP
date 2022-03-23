import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { AuthService } from './../Services/auth.service';
import { HttpService } from './../Services/http.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
})
export class Tab1Page {
  childs;
  constructor(
    public authService: AuthService,
    private router: Router,
    private httpService: HttpService
  ) {}
  logOut() {
    this.authService.logOut();
  }
  ngOnInit() {
    this.authService.childs.subscribe((res) => {
      // res.forEach((child) => {
      //   console.log(child);
      //   if (child != null) {
      //     if (
      //       child.img.includes('http://127.0.0.1:8000') &&
      //       environment.apiURL != 'http://localhost:8000/api/v1/'
      //     ) {
      //       var re = /http\:\/\/127\.0\.0\.1\:8000/gi;
      //       child.img = child.img.replace(re, environment.apiURL.substring(0,environment.apiURL.length-5));
      //       console.log(child.img);
      //     }
      //   }
      // });
      this.childs = res;
      // console.log(this.childs);
    });
    // this.childs = []
  }

  add() {
    this.router.navigate(['add-child']);
  }
}
