import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, } from '@angular/router';
import { AuthService } from './../Services/auth.service';

@Component({
  selector: 'app-child-details',
  templateUrl: './child-details.page.html',
  styleUrls: ['./child-details.page.scss'],
})
export class ChildDetailsPage implements OnInit {
  id: number
  currentChild
  constructor(private route: ActivatedRoute, private authService: AuthService) {
    this.id = this.route.snapshot.params.id
    this.currentChild = authService.childs.value.find(e => {
      return e.id == this.id
    })
  }

  ngOnInit() {

  }

}
