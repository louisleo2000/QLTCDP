import { Injectable } from '@angular/core';
import { HttpService } from './http.service';
import { StorageService } from './storage.service';
import { Router } from '@angular/router';
import { BehaviorSubject, Observable } from 'rxjs';
import { AuthConstants } from './../config/auth-constants';
import { format } from 'date-fns';
import { AlertAndLoadingService } from './alert-and-loading.service';
import { Network } from '@capacitor/network';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  userData = new BehaviorSubject(null);
  currentToken = new BehaviorSubject(null);
  childs = new BehaviorSubject([]);
  constructor(
    private httpService: HttpService,
    private storageService: StorageService,
    private router: Router,
    private alertAndLoading: AlertAndLoadingService
  ) {}
  async getUserData() {
    let user = await this.storageService.get(AuthConstants.AUTH);
    let token = await this.storageService.get('token');
    this.loadUser(token);
    this.userData.next(user);
    this.currentToken.next(token);
    // console.log(token)
  }
  //Hàm đăng nhập
  login(postData: any) {
    this.httpService.post('auth/login', postData).subscribe(
      async (res: any) => {
        if (res.success) {
          console.log(res.success)
          this.loadUser(res.token);
          await this.storageService.store('token', res.token);
          // await this.storageService.store(AuthConstants.AUTH, res.success)
          this.router.navigate(['tabs']);
        } else {
          console.log('Mật khẩu hoặc tài khoản không chính xác');
          this.alertAndLoading.dismissLoadling();
        }
      },
      (error) => {
        if (error.status == 500 || error.status == 0) {
          console.log('Không thể kết nối đến server');
          this.alertAndLoading.dismissLoadling();
          this.alertAndLoading.presentAlert(
            'Không thể kết nối đến server.Hãy kiểm tra lại kết nối của bạn!'
          );
        } else if (error.status == 422 || error.status == 401) {
          this.alertAndLoading.dismissLoadling();
          console.log('Mật khẩu hoặc tài khoản không chính xác');
          this.alertAndLoading.presentAlert(
            'Mật khẩu hoặc tài khoản không chính xác'
          );
        } else {
          this.alertAndLoading.dismissLoadling();
          console.log(error);
          this.alertAndLoading.presentAlert(error.message);
        }
      }
    );
  }
  signUp(postData: any): Observable<any> {
    return this.httpService.post('auth/register', postData);
  }
//hàm đăng xuất
  async logOut() {
    let token = await this.storageService.get('token');
    this.alertAndLoading.presentLoading();
    let url = 'auth/logout';
    this.httpService.get(url, token).subscribe(
      async (res) => {
        console.log(res);
        await this.storageService.clear();
        this.userData.next(null);
        this.childs.next([]);
        this.router.navigate(['']);
        this.alertAndLoading.dismissLoadling();
      },
      async (error) => {
        console.log(error);
        switch (error.status) {
          case 400:
            this.alertAndLoading.presentAlert('Lỗi yêu cầu');
            break;
          case 401:
            await this.storageService.clear();
            this.userData.next(null);
            this.childs.next([]);
            this.router.navigate(['']);
            this.alertAndLoading.dismissLoadling();
            break;
          case 500:
            this.alertAndLoading.presentAlert('Không thể kết nối đến server');
            break;
          default:
            this.alertAndLoading.presentAlert(error.message);
            break;
        }
        this.alertAndLoading.dismissLoadling();
      }
    );
  }

  addchild(postData: FormData, token: string): Observable<any> {
    return this.httpService.post('child/add', postData, token);
  }

  editchild(postData: FormData, token: string): Observable<any> {
    return this.httpService.post('child/edit', postData, token);
  }
//hàm lấy thông tin các con của người dùng hiện tại
  async getchild(token) {
    if (this.userData.value != null) {
     
      const status = await Network.getStatus();
      console.log('Online: '+ status.connected);
      let reschild = await this.storageService.get(AuthConstants.CHILD);
      if (reschild.length != this.childs.value.length) {
        this.childs.next(reschild);
      }
      if (status.connected) {
        let childs: any;
        let url = 'child/my-child';
        this.httpService.get(url, token).subscribe(
          async (res) => {
            // console.log(res)
            childs = res;
            if (childs) {
              childs.forEach((e) => {
                if (e.dob != undefined) {
                  e.age = this.calAge(new Date(e.dob));
                  e.dob = format(new Date(e.dob), 'dd/MM/yyyy');
                }
              });
              // if (childs.length != this.childs.value.length) {
                if (this.childs.value.length == 0) {
                  this.alertAndLoading.presentLoading();
                }
                console.log('Data children update');
                this.childs.next(childs);
                await this.storageService.store(AuthConstants.CHILD, childs);
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
            let reschild = await this.storageService.get(AuthConstants.CHILD);
            this.childs.next(reschild);
            return false;
          }
        );
      } else {
        this.alertAndLoading.dismissLoadling();
        return false;
      }
    } else {
      return false;
    }
  }
//Hàm load dữ liệu người dùng
  async loadUser(token) {
    const status = await Network.getStatus();
    let res = await this.storageService.get(AuthConstants.AUTH);
    // console.log(res);
    if (res) {
      this.userData.next(res);
      this.getchild(token);
      // console.log(res);
    }
    if (status.connected && token != null) {
      let url = 'auth/me';
      this.httpService.get(url, token).subscribe(
        async (res: any) => {
          if (res.success) {
            // console.log(res.success)
            this.userData.next(res.success);
            await this.storageService.store(AuthConstants.AUTH, res.success);
            this.getchild(token);
            this.alertAndLoading.dismissLoadling();
            return true;
          } else {
            this.alertAndLoading.dismissLoadling();
            return false;
          }
        },
        async (error) => {
          console.log(error);
          this.alertAndLoading.dismissLoadling();
          switch (error.status) {
            case 400:
              this.alertAndLoading.presentAlert('Lỗi yêu cầu');
              break;
            case 401:
              this.alertAndLoading.presentAlert(
                'Phiên đăng nhập hết hạn.Vui lòng đăng nhập lại'
              );
              //if click ok, logout
              this.logOut();
              break;
            case 500:
              this.alertAndLoading.presentAlert('Không thể kết nối đến server');
              break;
            default:
              this.alertAndLoading.presentAlert(error.message);
              break;
          }
          this.alertAndLoading.dismissLoadling();
          return false;
        }
      );
    } else {
      this.alertAndLoading.presentAlert('Không có kết nối mạng');
      let res = await this.storageService.get(AuthConstants.AUTH);
      if (res) {
        this.userData.next(res);
      }
      this.alertAndLoading.dismissLoadling();
    }
  }
//hàm tính tuổi
  calAge(dobDate) {
    let today = new Date();
    let age = {
      year: 0,
      month: 0,
      day: 0,
    };
    age.year = today.getFullYear() - dobDate.getFullYear();
    age.month = today.getMonth() - dobDate.getMonth();
    age.day = today.getDate() - dobDate.getDate();
    if (age.month <= 0) {
      age.year--;
      age.month = 12 + age.month;
    }
    if (age.day < 0) {
      age.month--;
      age.day = 30 + age.day;
    }
    if (age.month == 12 && age.day > 0) {
      age.year = age.year + 1;
      age.month = 0;
    }
    // console.log(age);
    return age;
  }
}
