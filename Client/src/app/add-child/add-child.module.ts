import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AddChildPageRoutingModule } from './add-child-routing.module';

import { AddChildPage } from './add-child.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AddChildPageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [AddChildPage]
})
export class AddChildPageModule {}
