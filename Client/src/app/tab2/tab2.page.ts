import { AlertAndLoadingService } from './../Services/alert-and-loading.service';
import { ScheduleService } from './../Services/schedule.service';
import { Component } from '@angular/core';
import { DatePipe } from '@angular/common';
import { format, parseISO } from 'date-fns';
@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss'],
})
export class Tab2Page {
  searchText;
  date2: string;
  type: 'string'; // 'string' | 'js-date' | 'moment' | 'time' | 'object'
  maxDate: string;
  onChange(value) {
    this.searchText = format(parseISO(value), 'dd-MM-yyyy');
    console.log(this.searchText);
  }
  allschedule: any = [];
  pipe = new DatePipe('en-US');
  date = {
    day: {
      Monday: 'Thứ hai',
      Tuesday: 'Thứ ba',
      Wednesday: 'Thứ tư',
      Thursday: 'Thứ năm',
      Friday: 'Thứ sáu',
      Saturday: 'Thứ bảy',
      Sunday: 'Chủ nhật',
    },
    month: {
      January: 'Tháng 1',
      February: 'Tháng 2',
      March: 'Tháng 3',
      April: 'Tháng 4',
      May: 'Tháng 5',
      June: 'Tháng 6',
      July: 'Tháng 7',
      August: 'Tháng 8',
      September: 'Tháng 9',
      October: 'Tháng 10',
      November: 'Tháng 11',
      December: 'Tháng 12',
    },
  };

  constructor(
    private schedule: ScheduleService,
    private alertAndLoading: AlertAndLoadingService
  ) {

    //get current date and plus 1 year and format
    let date = new Date();
    date.setFullYear(date.getFullYear() + 1);
    this.maxDate = this.pipe.transform(date, 'yyyy-MM-dd');


  }
  ngOnInit() {
    this.onLoad();
  }
  onLoad() {
    this.schedule.getAllSchedule();
    this.schedule.allSchedule.subscribe((res: any) => {
      if (res && res.data) {
        // console.log(res.data.schedules);
        res.data.schedules.forEach((element) => {
          //
          let datetime = element.date_time.split(' ');
          let date;

          date = new Date(datetime[0]);
          // console.log(date);
          if (date.toString() != 'Invalid Date') {
            let day = this.pipe.transform(date, 'EEEE');
            let month = this.pipe.transform(date, 'MMMM');
            element.date_time = this.pipe.transform(date, 'EEEE, dd-MM-y');
            element.date_time = element.date_time.replace(
              day,
              this.date.day[day]
            );
            element.time = datetime[1].substr(0, datetime[1].length - 3);
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
