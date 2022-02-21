import { NgModule } from '@angular/core';
import { Routes, RouterModule,  } from '@angular/router';
  import { ChildDetailsGuard } from './../guard/child-details.guard';
import { ChildDetailsPage } from './child-details.page';

const routes: Routes = [
  {
    path: '',
    component: ChildDetailsPage,
    canActivate: [ChildDetailsGuard],
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],

exports: [RouterModule],
})
export class ChildDetailsPageRoutingModule {}
