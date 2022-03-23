import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from './../../environments/environment';
@Injectable({
  providedIn: 'root'
})
export class HttpService {

  constructor(private http: HttpClient) { }
  post(serviceName: string,data: any){
    const headers = new HttpHeaders()
    headers.append("Accept", 'application/json');
    headers.append('Content-Type', 'application/json' );
    const options = { header:headers,withCredentials:false}
    const url = environment.apiURL + serviceName
    return this.http.post(url,(data),options)
  }
   get(serviceName: string, token: string) {
    const headers = new HttpHeaders({
      'Content-Type':  'application/json',
      Authorization: 'Bearer ' + token
    })   
    const url = environment.apiURL + serviceName
      return  this.http.get(url,{headers:headers})
  }
}
