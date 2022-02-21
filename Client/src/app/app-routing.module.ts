import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'tabs',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule)
  },
  {
    path: '',
    loadChildren: () => import('./stack/stack.module').then( m => m.StackPageModule)
  },
  {
    path: 'add-child',
    loadChildren: () => import('./add-child/add-child.module').then( m => m.AddChildPageModule)
  },
  {
    path: 'child-details/:id',
    loadChildren: () => import('./child-details/child-details.module').then( m => m.ChildDetailsPageModule)
  },



];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
