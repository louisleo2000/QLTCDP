import { FcmService } from './Services/fcm.service';
import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  constructor(private fcmService: FcmService) {
    this.initializeApp();
  }

  initializeApp() {
    this.fcmService.initPush();
  }
}
