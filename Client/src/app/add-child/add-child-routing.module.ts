import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ChildDetailsGuard } from '../guard/child-details.guard';
import { HomeGuard } from '../guard/home.guard';

import { AddChildPage } from './add-child.page';

const routes: Routes = [
  {
    path: '',
    canActivate: [HomeGuard],
    component: AddChildPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AddChildPageRoutingModule {}
