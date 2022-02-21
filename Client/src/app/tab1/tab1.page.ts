import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from './../Services/auth.service';
import { HttpService } from './../Services/http.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page {
  childs
  constructor(public authService: AuthService, private router: Router, private httpService: HttpService) { }
  logOut() {
    this.authService.logOut()
  }
  ngOnInit() {
    this.authService.childs.subscribe(res => {
      this.childs = res
    })
  }

  add() {
    this.router.navigate(['add-child'])
  }

}
