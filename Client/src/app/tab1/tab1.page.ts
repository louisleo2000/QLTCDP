import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { AuthService } from './../Services/auth.service';
import { HttpService } from './../Services/http.service';
import { Network } from '@capacitor/network';
import { StorageService } from '../Services/storage.service';
@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
})
export class Tab1Page {
  childs;
  defaultImage = './../../assets/icon/loading-1.gif';
  networkStatus: boolean = false;
  constructor(
    public authService: AuthService,
    private router: Router,
    private httpService: HttpService,
    private storageService: StorageService
  ) {}
  logOut() {
    this.authService.logOut();
  }

  ngOnInit() {
    Network.addListener('networkStatusChange', (status) => {
      this.networkStatus = status.connected;
      console.log('Network status changed', status);
    });
    this.authService.childs.subscribe(async (res) => {
      if (res) {
        res.forEach((child) => {
          if (child != null) {
            if (
              child.img.includes('http://127.0.0.1:8000') &&
              !environment.apiURL.includes('http://127.0.0.1:8000')
            ) {
              var re = /http\:\/\/127\.0\.0\.1\:8000/gi;
              child.img = child.img.replace(re, environment.host);
              // console.log(child.img);
            }
          }
        });
        this.childs = res;
        let darkmode = await this.storageService.get('darkmode');
        if (darkmode) {
          document.body.setAttribute('color-theme', 'dark');
        } else {
          document.body.setAttribute('color-theme', 'light');
        }
      }
      // console.log(this.childs);
    });
    // this.childs = []
  }

  add() {
    this.router.navigate(['add-child']);
  }
}
