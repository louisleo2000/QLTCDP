import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthConstants } from '../config/auth-constants';
import { StorageService } from './../Services/storage.service';

@Injectable({
  providedIn: 'root'
})
export class HomeGuard implements CanActivate {


  constructor(public storageService: StorageService, private router: Router) { }
  async getStorage() {
    try {
      let data = await this.storageService.get(AuthConstants.AUTH)
      if (data) {
        return true
      }
      else {
        this.router.navigate([''])
        return false
      }
    } catch (error) {
      console.log(error);
      return false
    }
  }
  canActivate(): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this.getStorage();
  }
}
