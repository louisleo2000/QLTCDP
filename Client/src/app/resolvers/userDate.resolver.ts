import { Injectable } from "@angular/core";
import { AuthService } from './../Services/auth.service';


@Injectable({
  providedIn: 'root'
})
export class UserDataResolver {
  constructor(private authService: AuthService) {

  }
  resolve(){
    console.log('Load data')
    return this.authService.getUserData()
  }
}
