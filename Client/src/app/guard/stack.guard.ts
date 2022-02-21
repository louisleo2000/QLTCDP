import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthConstants } from '../config/auth-constants';
import { StorageService } from './../Services/storage.service';

@Injectable({
  providedIn: 'root'
})
export class StackGuard implements CanActivate {

  constructor(public storageService: StorageService, private router: Router) { }
  async getStorage() {

    try {
      let data = await this.storageService.get(AuthConstants.AUTH)
      if (data) {
        this.router.navigate(['tabs'])
       return false
      }
      else {
        return true

      }
    } catch (error) {
      console.log(error);
      return true
    }

  }
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this.getStorage();
  }

}
