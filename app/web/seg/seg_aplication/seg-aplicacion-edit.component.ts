import { Component, ElementRef,OnInit, ViewChild, ChangeDetectorRef } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatSort} from '@angular/material/sort';
import {MatTable, MatTableDataSource} from '@angular/material/table';
import { BreakpointObserver, Breakpoints, BreakpointState } from '@angular/cdk/layout';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
declare var require: any;

//import { Seg_moduloService } from './../../../core/seg/seg_modulo/service/Seg_modulo.service';
//import { Seg_moduloModel } from './../../../core/seg/seg_modulo/model/Seg_modulo.model';

import { Seg_aplicacionService } from 'app/core/seg_aplicacion/service/seg_aplicacion.service';
import { Seg_aplicacionModel } from '../../../core/seg_aplicacion/model/seg_aplicacion.model';


@Component({
  selector: 'app-seg_aplication',
  templateUrl: './seg-aplicacion-edit.component.html',
  styleUrls: ['./../common/common.component.scss']
})


export class SegAplicaionComponent implements OnInit {

    displayedColumns = ['Opciones', 'Cod','Dsc'];
    dataSource: any;
    searchfilter: any;
    pagination: any;
    vmodcod:string;
    vmoddsc:string;
    @ViewChild('paginator')  paginator !: MatPaginator;
    @ViewChild('pdfReport')  pdfReport!: ElementRef;
    constructor(breakpointObserver: BreakpointObserver, private router: Router,
      private http: HttpClient,
      private changeDetectorRefs: ChangeDetectorRef,
      fb: FormBuilder,
      private seg_aplicacionService: Seg_aplicacionService,
      private rutaActiva: ActivatedRoute,
  
    ) {
        this.vmodcod= this.rutaActiva.snapshot.params["modcod"];
        this.vmoddsc= this.rutaActiva.snapshot.params["moddsc"];
      breakpointObserver.observe(['(max-width: 500px)']).subscribe(result => {
        this.displayedColumns = result.matches ?
          ['Opciones', 'Cod','Dsc'] :
          ['Opciones', 'Cod','Dsc'];
      });
      this.searchfilter = {
        draw: 1,
        searchfor: '',
        page: 1,
        cod_mod:this.vmodcod

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
      this.seg_aplicacionService.getAllPage(this.searchfilter, data => {
        if (data['NRO'] >= 0) {
          this.dataSource = new MatTableDataSource<Seg_aplicacionModel>(data['DATA']);
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
      this.router.navigate(['/seg/mod/V/' + event.moddsc], { skipLocationChange: true });
    }
    viewdetails(event:any) {
        var modcod= event.cod_mod;
        var moddsc= event.dsc_mod;
        this.router.navigate(['/seg/modapl/'+modcod+'/'+moddsc+'/'], { skipLocationChange: true });
      }
    edit(event:any) {
      this.router.navigate(['/seg/mod/E/' + event.moddsc], { skipLocationChange: true });
    }
    delete(event:any) {
      this.router.navigate(['/seg/mod/D/' + event.moddsc], { skipLocationChange: true });
    }
              
  }
  