import { environment } from './../../environments/environment';
import { Component } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import { HttpService } from './../Services/http.service';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {
  currentUser
  constructor(
    private authService: AuthService,
    private httpService:HttpService) {

  }
  logOut() {
    this.authService.logOut()
  }
  ngOnInit() {
    this.authService.userData.subscribe(res =>{
      // var re = /http\:\/\/127\.0\.0\.1\:8000/gi;
      // if(res && environment.apiURL != 'http://127.0.0.1:8000/api/v1/'){
      //   res.img = res.img.replace(re, environment.apiURL.substring(0,environment.apiURL.length-5))
      // }
      this.currentUser = res
      // console.log("res: ",res)

    })
  }
}
