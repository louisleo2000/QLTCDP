import { Injectable } from '@angular/core';
import { AlertController, LoadingController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class AlertAndLoadingService {
  isLoading
  constructor(
    public alertController: AlertController,
    public loadingController: LoadingController
  ) { }

  async presentAlert(message: string) {
    const alert = await this.alertController.create({
      header: 'Thông báo',
      message: message,
      buttons: ['OK']
    });

    await alert.present();
  }
  async presentLoading() {
    this.isLoading = await this.loadingController.create({
      message: 'Đợi một chút...',
      duration: 2000
    });
    this.isLoading.present();
  }
  dismissLoadling()
  {
    if(this.isLoading)
    {
      this.isLoading.dismiss()
    }
  }
}
