import { AlertAndLoadingService } from './../Services/alert-and-loading.service';
import { ScheduleService } from './../Services/schedule.service';
import { Component } from '@angular/core';
import { DatePipe } from '@angular/common';
@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss'],
})
export class Tab2Page {
  allschedule: any = [];
  pipe = new DatePipe('en-US');
  searchText;
  constructor(
    private schedule: ScheduleService,
    private alertAndLoading: AlertAndLoadingService
  ) {}
  ngOnInit() {
    this.onLoad();
  }
  onLoad() {
    this.schedule.getAllSchedule();
    this.schedule.allSchedule.subscribe((res: any) => {
      if (res.data) {
        // console.log(res.data.schedules);
        res.data.schedules.forEach((element) => {
          //
          let datetime = element.date_time.split(' ');
          let date;

          date = new Date(datetime[0]);
          // console.log(date);
          if (date.toString() != 'Invalid Date') {
            element.date_time = this.pipe.transform(date, 'EEEE, MMMM dd, y');
            element.time = datetime[1];
          }
          // console.log(element.date_time);
        });

        this.allschedule = res.data.schedules;
        this.alertAndLoading.dismissLoadling();
      }
    });
  }
  onSearch(ev: any) {
    // set val to the value of the searchbar
    const val = ev.target.value;

    // if the value is an empty string don't filter the items
    if (val && val.trim() != '') {
      this.allschedule = this.allschedule.filter((item) => {
        return item.vaccine.name.toLowerCase().indexOf(val.toLowerCase()) > -1;
      });
    } else {
      this.ngOnInit();
    }
  }
  doRefresh($event) {
    this.onLoad();
    setTimeout(() => {
      this.alertAndLoading.dismissLoadling();
      $event.target.complete();
    }, 2000);
  }
}
