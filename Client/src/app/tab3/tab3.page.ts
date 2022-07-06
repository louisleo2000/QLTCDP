import { environment } from './../../environments/environment';
import { Component } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import { HttpService } from './../Services/http.service';
import { StorageService } from '../Services/storage.service';
import { Capacitor } from '@capacitor/core';
@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
})
export class Tab3Page {
  currentUser;
  darkmode: boolean = false;
  isPushNotificationsAvailable =
    Capacitor.isPluginAvailable('PushNotifications');
  constructor(
    private authService: AuthService,
    // private httpService: HttpService,
    private storageService: StorageService
  ) {}

  logOut() {
    this.authService.logOut();
  }
  ngOnInit() {
    this.authService.userData.subscribe(async (res) => {
      // var re = /http\:\/\/127\.0\.0\.1\:8000/gi;
      // if(res && environment.apiURL != 'http://127.0.0.1:8000/api/v1/'){
      //   res.img = res.img.replace(re, environment.apiURL.substring(0,environment.apiURL.length-5))
      // }
      this.currentUser = res;
      // console.log("res: ",res)
      this.darkmode = await this.storageService.get('darkmode');
      if (this.darkmode) {
        document.body.setAttribute('color-theme', 'dark');
      } else {
        document.body.setAttribute('color-theme', 'light');
      }
    });
    
  }
  async darkMode($event) {
    let mode = $event.target.checked ? 'dark' : 'light';
    if ($event.detail.checked) {
      document.body.setAttribute('color-theme', mode);
    } else {
      document.body.setAttribute('color-theme', mode);
    }
    await this.storageService.store('darkmode', $event.target.checked);
  }
}
