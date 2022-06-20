import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from './../Services/auth.service';

@Component({
  selector: 'app-child-details',
  templateUrl: './child-details.page.html',
  styleUrls: ['./child-details.page.scss'],
})
export class ChildDetailsPage implements OnInit {
  id: number;
  currentChild;
  searchText;
 isHistoryOpen: boolean = false;
  isModalOpen: boolean = false;
  constructor(private route: ActivatedRoute, private authService: AuthService) {
    this.id = this.route.snapshot.params.id;
    this.currentChild = authService.childs.value.find((e) => {
      if (e.id == this.id) {
        // console.log(e.vaccination_details);
        const counts = {};
        e.vaccination_details.forEach(function (x) {
          if (counts[x.vaccine.id] == undefined) {
            counts[x.vaccine.id] = { number: [], name: '' };
          }
          counts[x.vaccine.id] = {
            // number: (counts[x.vaccine.id].number || 0) + 1,
            name: x.vaccine.name,
            number: counts[x.vaccine.id].number.concat([
              counts[x.vaccine.id].number.length + 1,
            ]),
          };
        });
        // console.log(counts);
        e.counts = [];
        for (var i in counts) e.counts.push(counts[i]);
        // console.log(e);
      }
      return e.id == this.id;
    });
  }

  ngOnInit() {}
}
