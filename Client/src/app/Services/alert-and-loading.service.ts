import { Injectable } from '@angular/core';
import { AlertController, LoadingController } from '@ionic/angular';

@Injectable({
  providedIn: 'root',
})
export class AlertAndLoadingService {
  isLoading;
  constructor(
    public alertController: AlertController,
    public loadingController: LoadingController
  ) {}

  async presentAlert(message: string) {
    const alert = await this.alertController.create({
      header: 'Thông báo',
      message: message,
      buttons: ['OK'],
    });

    await alert.present();
  }
  async presentLoading() {
    console.log('loading');
    this.isLoading = await this.loadingController.create({
      message: 'Đợi một chút...',
      duration: 10000,
    });
    this.isLoading.present();
  }
  dismissLoadling() {
    let i =  setInterval(() => {
      if (this.isLoading) {
        this.isLoading.dismiss();
        console.log('dismiss');
        
        clearInterval(i);
      }
    }, 1000);
  }
}
