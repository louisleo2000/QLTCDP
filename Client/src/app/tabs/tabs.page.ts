import { Component } from '@angular/core';
import { AlertAndLoadingService } from './../Services/alert-and-loading.service';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss']
})
export class TabsPage {

  constructor(private alertAndLoadingService:AlertAndLoadingService) {}
ngOnInit()
{
  this.alertAndLoadingService.dismissLoadling();
}
}
