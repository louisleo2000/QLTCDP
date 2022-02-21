import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { StackGuard } from '../guard/stack.guard';

import { StackPage } from './stack.page';

const routes: Routes = [
  {
    path: 'stack',
    component: StackPage,
    canActivate: [StackGuard],
    children: [
      {
        path: 'login',
        loadChildren: () => import('../login/login.module').then(m => m.LoginPageModule)
      },
      {
        path: 'signup',
        loadChildren: () => import('../signup/signup.module').then(m => m.SignupPageModule)
      },

      {
        path: '',
        redirectTo: '/stack/login',
        pathMatch: 'full'
      }
    ]
  },
  {
    path: '',
    redirectTo: '/stack/login',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],

exports: [RouterModule],
})
export class StackPageRoutingModule {}
