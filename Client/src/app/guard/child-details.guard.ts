import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthConstants } from '../config/auth-constants';
import { StorageService } from '../Services/storage.service';
import { AuthService } from './../Services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class ChildDetailsGuard implements CanActivate {
  constructor(private auth: AuthService, private router: Router) { }
  getChild() {
    try {
      if (this.auth.childs.value.length >0) {
        return true
      }
      else {
        this.router.navigate(['tabs'])
        return false
      }
    } catch (error) {
      console.log(error);
      return false
    }
  }
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this.getChild();
  }

}
