import { NgModule } from "@angular/core";
//import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from "@angular/router";
import { HttpClientModule } from "@angular/common/http";
import { CommonModule } from "@angular/common";
//import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { MatButtonModule } from "@angular/material/button";
import { MatCheckboxModule } from "@angular/material/checkbox";
import { MatInputModule } from "@angular/material/input";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";



import { MatTableModule } from "@angular/material/table";
import { MatFormFieldModule } from "@angular/material/form-field";
import { MatPaginatorModule } from "@angular/material/paginator";
import { MatGridListModule } from "@angular/material/grid-list";
import { MatTabsModule } from "@angular/material/tabs";
import { LayoutModule } from "@angular/cdk/layout";
import { MatListModule } from "@angular/material/list";
import { MatMenuModule } from "@angular/material/menu";
import { MatSnackBarModule } from "@angular/material/snack-bar";
import { MatAutocompleteModule } from "@angular/material/autocomplete";
import { MatSelectModule } from "@angular/material/select";
import { MatTooltipModule } from "@angular/material/tooltip";
import { MatToolbarModule } from "@angular/material/toolbar";
import { MatProgressSpinnerModule } from "@angular/material/progress-spinner";
import { MatCardModule } from "@angular/material/card";
import { MatIconModule } from "@angular/material/icon";
import { MatButtonToggleModule } from "@angular/material/button-toggle";
import { MatDialogModule } from "@angular/material/dialog";

import { MatExpansionModule } from "@angular/material/expansion";



import { MAT_DATE_LOCALE } from "@angular/material/core";
import { MAT_DATE_FORMATS } from "@angular/material/core";
import { DateAdapter } from "@angular/material/core";
import { MatDateFormats } from "@angular/material/core";
import { MatDatepickerModule } from "@angular/material/datepicker";

import { MatNativeDateModule } from "@angular/material/core";




import {MatSlideToggleModule} from '@angular/material/slide-toggle';
import {MatRadioModule} from '@angular/material/radio';
// create our cost var with the information about the format that we want
// Datatime
//import {MatDatetimepickerModule} from '@mat-datetimepicker/core';
//import {MatMomentDatetimeModule} from '@mat-datetimepicker/moment';
//Settings
//import { SetInfoComponent } from './settings/set-info/set-info.component';
//import { SetChpswComponent } from './settings/set-chpsw/set-chpsw.component';

export const MY_FORMATS = {
  parse: {
    dateInput: "DD/MM/YYYY",
  },
  display: {
    dateInput: "DD/MM/YYYY",
    monthYearLabel: "MM YYYY",
    dateA11yLabel: "DD/MM/YYYY",
    monthYearA11yLabel: "MM YYYY",
  },
};

import {SegRoutingModule} from './seg-routing.module'

import { SegModuloComponent } from './seg-modulo/seg-modulo.component';
import { SegModuloEditComponent } from './seg-modulo-edit/seg-modulo-edit.component';
import { SegAplicaionComponent } from "./seg_aplication/seg-aplicacion-edit.component";


@NgModule({
  declarations: [

    SegModuloComponent,
    SegModuloEditComponent,
    SegAplicaionComponent
  ],
  imports: [
    RouterModule.forChild(SegRoutingModule),
    CommonModule,
    MatInputModule,
    MatCheckboxModule,
    MatButtonModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
 
    MatTableModule,
    MatFormFieldModule,
    MatPaginatorModule,
    MatGridListModule,
    MatTabsModule,
    LayoutModule,
    MatListModule,
    MatMenuModule,
    MatSnackBarModule,
    MatAutocompleteModule,
    MatSelectModule,
    MatTooltipModule,
    MatToolbarModule,
    MatProgressSpinnerModule,
    MatCardModule,
    MatIconModule,
    MatButtonToggleModule,
    MatDialogModule,
  //  BrowserAnimationsModule ,
    MatExpansionModule,
    MatDatepickerModule,
    MatNativeDateModule,

    MatSlideToggleModule,
    MatRadioModule,
   // MatTimepickerModule,
  //  MatMomentDateModule,

  ]
})
export class SegModule { }

