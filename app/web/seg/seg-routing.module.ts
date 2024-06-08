import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';



import {SegModuloComponent} from './seg-modulo/seg-modulo.component';
import {SegModuloEditComponent} from './seg-modulo-edit/seg-modulo-edit.component';

import { SegAplicaionComponent } from './seg_aplication/seg-aplicacion-edit.component';




export const SegRoutingModule: Routes = [

  {
    path: 'mod',
    component: SegModuloComponent
  },
  {
    path: 'mod/:ope/:modcod',
    component: SegModuloEditComponent
  },

  {
    path: 'modapl/:modcod/:moddsc',
    component: SegAplicaionComponent
  },
  
];