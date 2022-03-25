import { Injectable } from '@angular/core';
import { HttpService } from './http.service';
import { StorageService } from './storage.service';
import { Router } from '@angular/router';
import { BehaviorSubject, Observable } from 'rxjs';
import { AuthConstants } from './../config/auth-constants';
import { format } from 'date-fns';
import { AlertAndLoadingService } from './alert-and-loading.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  userData = new BehaviorSubject(null)
  childs = new BehaviorSubject([])
  constructor(private httpService: HttpService, private storageService: StorageService, private router: Router, private alertAndLoading: AlertAndLoadingService) { }
  async getUserData() {
    let user = await this.storageService.get(AuthConstants.AUTH)
    let token = await this.storageService.get('token')
    this.loadUser(token)
    this.userData.next(user)
    // console.log(token)
    this.getchild(token)
  }
  login(postData: any) {
    this.httpService.post('auth/login', postData).subscribe(async (res: any) => {
      if (res.success) {
        // console.log(res.success)
        this.loadUser(res.token)
        await this.storageService.store('token', res.token)
        // await this.storageService.store(AuthConstants.AUTH, res.success)
        this.router.navigate(['tabs'])
        this.alertAndLoading.dismissLoadling()
      }
      else {
        console.log('Mật khẩu hoặc tài khoản không chính xác')
        this.alertAndLoading.dismissLoadling()
      }
    },
      (error) => {
        if (error.status == 500 || error.status == 0) {
          console.log("Không thể kết nối đến server")
          this.alertAndLoading.dismissLoadling()
          this.alertAndLoading.presentAlert("Không thể kết nối đến server.Hãy kiểm tra lại kết nối của bạn!");

        } else if (error.status == 422 || error.status == 401) {
          this.alertAndLoading.dismissLoadling()
          console.log('Mật khẩu hoặc tài khoản không chính xác')
          this.alertAndLoading.presentAlert("Mật khẩu hoặc tài khoản không chính xác");
        }
        else {
          this.alertAndLoading.dismissLoadling()
          console.log(error)
          this.alertAndLoading.presentAlert(error.message)
        }

      })
  }
  signUp(postData: any): Observable<any> {
    return this.httpService.post('auth/register', postData)
  }

  async logOut() {
    await this.storageService.clear()
    this.userData.next(null)
    this.childs.next([])
    this.router.navigate([''])
  }

  addchild(postData: FormData): Observable<any> {
    postData.append('parent_id', this.userData.value.id)
    return this.httpService.post('child/add', postData)
  }

  async getchild(token) {
    if (this.userData.value != null) {
      let childs: any
      let url = 'child/my-child'
      this.httpService.get(url,token).subscribe(async res => {
        // console.log(res)
        childs = res
        if (childs) {
          childs.forEach(e => {
            if (e.dob != undefined) {
              e.age = this.calAge(new Date(e.dob))
              e.dob = format(new Date(e.dob), 'dd/MM/yyyy')
            }
          });
          this.childs.next(childs)
          await this.storageService.store(AuthConstants.CHILD, childs)
          this.alertAndLoading.dismissLoadling()
          return true
        }
        else {
          this.alertAndLoading.dismissLoadling()
          return false
        }

      },
        async (error) => {
          console.log(error)
          let reschild = await this.storageService.get(AuthConstants.CHILD)
          this.childs.next(reschild)
          return false
        }
      )
    }
    else {
      return false
    }
  }

  async loadUser(token) {
    let url = 'auth/me'
    this.httpService.get(url,token).subscribe(async (res:any) => {
      if (res.success) {
        // console.log(res.success)
        this.userData.next(res.success)
        await this.storageService.store(AuthConstants.AUTH, res.success)
        this.alertAndLoading.dismissLoadling()
        return true
      }
      else {
        this.alertAndLoading.dismissLoadling()
        return false
      }
    },
      async (error) => {
        console.log(error)
        let res = await this.storageService.get(AuthConstants.AUTH)
        if (res) { this.userData.next(res) }
        this.alertAndLoading.dismissLoadling()
        return false
      }
    )

  }


  calAge(dobDate) {
    let today = new Date();
    let age = {
      'year': 0,
      'month': 0,
      'day': 0
    }
    age.year = today.getFullYear() - dobDate.getFullYear();
    age.month = today.getMonth() - dobDate.getMonth();
    age.day = today.getDate() - dobDate.getDate();
    if (age.month <= 0) {
      age.year--;
      age.month = (12 + age.month);
    }
    if (age.day < 0) {
      age.month--;
      age.day = 30 + age.day;
    }
    if (age.month == 12 && age.day > 0) {
      age.year = age.year + 1;
      age.month = 0;
    }
    return age
  }
}
