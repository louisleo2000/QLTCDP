import { Router } from '@angular/router';
import { environment } from './../../environments/environment';
import { Component, Injectable } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import { HttpService } from './../Services/http.service';
import { StorageService } from '../Services/storage.service';
import {
  ActionPerformed,
  PushNotifications,
  PushNotificationSchema,
} from '@capacitor/push-notifications';
import { Capacitor } from '@capacitor/core';
@Injectable({
  providedIn: 'root',
})
export class FcmService {
  token: string = '';
  isPushNotificationsAvailable =
    Capacitor.isPluginAvailable('PushNotifications');
  constructor(private router: Router) {}

  initPush() {
    if (Capacitor.platform !== 'web') {
      this.registerPush();
    }
  }

  private registerPush() {
    if (this.isPushNotificationsAvailable) {
      PushNotifications.requestPermissions().then((result) => {
        if (result.receive === 'granted') {
          // Register with Apple / Google to receive push via APNS/FCM
          PushNotifications.register();
        } else {
          // Show some error
        }
      });

      PushNotifications.addListener('registration', (token) => {
        // console.log(token);
        console.log('Push registration success, token: ' + token.value);
        this.token = token.value;
      });

      PushNotifications.addListener('registrationError', (error: any) => {
        console.log('Error on registration: ' + JSON.stringify(error));
      });

      PushNotifications.addListener(
        'pushNotificationReceived',
        async (notification: PushNotificationSchema) => {
          //   console.log('Push received: ' + JSON.stringify(notification));
        }
      );

      PushNotifications.addListener(
        'pushNotificationActionPerformed',
        async (notification: ActionPerformed) => {
          const data = notification.notification.data;
          //   console.log(
          //     'Push action performed: ' +
          //       JSON.stringify(notification.notification.data)
          //   );
          if (data.detailsId) {
            this.router.navigateByUrl(`/home/${data.detailsId}`);
          }
        }
      );
    }
  }
}
