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
      this.currentUser = res
    })
  }
}
