import { AuthService } from './auth.service';
import { BehaviorSubject } from 'rxjs';
import { Network } from '@capacitor/network';
import { AlertAndLoadingService } from './alert-and-loading.service';
import { Router } from '@angular/router';
import { StorageService } from './storage.service';
import { HttpService } from './http.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ScheduleService {
  allSchedule = new BehaviorSubject([]);
  constructor(  private httpService: HttpService,
    private storageService: StorageService,
    private router: Router,
    private authService: AuthService,
    private alertAndLoading: AlertAndLoadingService) { }
    
//Hàm lấy thông tin lịch tiêm chủng
  async getAllSchedule() {

      const status = await Network.getStatus();
      console.log(status.connected);
      if (status.connected) {
        this.alertAndLoading.presentLoading()
        let schedule: any;
        let url = 'schedule/all';
        this.httpService.get(url, this.authService.currentToken.value).subscribe(
          async (res) => {
            
            // console.log(res)
            schedule = res;
            if (schedule) {
              // if (schedule.length != this.allSchedule.value.length) {
                console.log('get schedule from server');
                this.allSchedule.next(schedule);
              // }
              this.alertAndLoading.dismissLoadling();
              return true;
            } else {
              this.alertAndLoading.dismissLoadling();
              return false;
            }
          },
          async (error) => {
            console.log(error);
            this.allSchedule.next(schedule);
            return false;
          }
        );
      } else {
        this.alertAndLoading.dismissLoadling();
        return false;
      }
   
  }
}
