import { Component, ElementRef,OnInit, ViewChild, ChangeDetectorRef } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatSort} from '@angular/material/sort';
import {MatTable, MatTableDataSource} from '@angular/material/table';
import { BreakpointObserver, Breakpoints, BreakpointState } from '@angular/cdk/layout';
import { Router } from '@angular/router';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
declare var require: any;

import { Seg_moduloService } from './../../../core/seg/seg_modulo/service/Seg_modulo.service';
import { Seg_moduloModel } from './../../../core/seg/seg_modulo/model/Seg_modulo.model';


@Component({
  selector: 'app-seg-modulo',
  templateUrl: './seg-modulo.component.html',
  styleUrls: ['./../common/common.component.scss']
})
export class SegModuloComponent implements OnInit {

  displayedColumns = ['Opciones', 'Cod','Dsc'];
  dataSource: any;
  searchfilter: any;
  pagination: any;
  @ViewChild('paginator')  paginator !: MatPaginator;
  @ViewChild('pdfReport')  pdfReport!: ElementRef;
  constructor(breakpointObserver: BreakpointObserver, private router: Router,
    private http: HttpClient,
    private changeDetectorRefs: ChangeDetectorRef,
    fb: FormBuilder,
    private seg_moduloService: Seg_moduloService,

  ) {
    breakpointObserver.observe(['(max-width: 500px)']).subscribe(result => {
      this.displayedColumns = result.matches ?
        ['Opciones', 'Cod','Dsc'] :
        ['Opciones', 'Cod','Dsc'];
    });
    this.searchfilter = {
      draw: 1,
      searchfor: '',
      page: 1

    };
    this.pagination = {
      pageIndex: 1,
      length: 0,
      boundaryLinks: true,
      pageSize: 10,
      nextText: 'Siguiente',
      previousText: 'Anterior',
      firstText: 'Primero',
      lastText: 'Último'
    };
    this.getPaginateList();
  }
  ngOnInit() { }
getPaginatorSearch() {
    this.pagination = {
      pageIndex: 1,
      length: 0,
      boundaryLinks: true,
      pageSize: 10,
      nextText: 'Siguiente',
      previousText: 'Anterior',
      firstText: 'Primero',
      lastText: 'Último'
    };
    this.getPaginateList();
  }
  getPaginateList() {
    this.seg_moduloService.getAllPage(this.searchfilter, data => {
      if (data['NRO'] >= 0) {
        this.dataSource = new MatTableDataSource<Seg_moduloModel>(data['DATA']);
        this.pagination.length = data['LENGTH'];
        this.changeDetectorRefs.detectChanges();
      }
    });
  }
  getPaginatorData(event:any) {
    this.pagination.pageIndex = event.pageIndex + 1;
    this.searchfilter.page = event.pageIndex + 1;
    this.getPaginateList();
  }
  newrecord() {
    this.router.navigate(['/seg/mod/N/0'], { skipLocationChange: true });
  }
  view(event:any) {
    this.router.navigate(['/seg/mod/V/' + event.cod_mod], { skipLocationChange: true });
  }
  viewdetails(event:any) {
    var modcod= event.cod_mod;
    var moddsc= event.dsc_mod;
    this.router.navigate(['/seg/modapl/'+modcod+'/'+moddsc+'/'], { skipLocationChange: true });
  }
  
  edit(event:any) {
    this.router.navigate(['/seg/mod/E/' + event.cod_mod], { skipLocationChange: true });
  }
  delete(event:any) {
    this.router.navigate(['/seg/mod/D/' + event.cod_mod], { skipLocationChange: true });
  }
            
}
