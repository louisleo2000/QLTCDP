import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ChildDetailsPageRoutingModule } from './child-details-routing.module';

import { ChildDetailsPage } from './child-details.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ChildDetailsPageRoutingModule
  ],
  declarations: [ChildDetailsPage]
})
export class ChildDetailsPageModule {}
