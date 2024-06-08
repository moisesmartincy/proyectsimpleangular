import { Component, ElementRef,OnInit, ViewChild, ChangeDetectorRef } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatSort} from '@angular/material/sort';
import {MatTable, MatTableDataSource} from '@angular/material/table';
import { BreakpointObserver, Breakpoints, BreakpointState } from '@angular/cdk/layout';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
declare var require: any;

import { Seg_moduloModel } from 'app/core/seg/seg_modulo/model/Seg_modulo.model';
import { Seg_moduloService } from 'app/core/seg/seg_modulo/service/Seg_modulo.service';
import { SwMsgservice } from 'app/core/swmsg/service/swmsg.service';


import Swal from 'sweetalert2';


@Component({
  selector: 'app-seg-modulo-edit',
  templateUrl: './seg-modulo-edit.component.html',
  styleUrls: ['./../common/common.component.scss']
})
export class SegModuloEditComponent implements OnInit {
  recordNew !:Seg_moduloModel;
  recordEdit !:Seg_moduloModel;
  recordView !:Seg_moduloModel;
  voption:string;
  vmodcod:string;
  constructor(
    breakpointObserver: BreakpointObserver,
    private rutaActiva:ActivatedRoute,
    private router: Router,
    private http: HttpClient,
    private changeDetectorRefs: ChangeDetectorRef,
    fb: FormBuilder,
    private seg_moduloService: Seg_moduloService,
    private msgservice: SwMsgservice,
  
  ) {
    
    
    this.recordEdit= new Seg_moduloModel();
    this.recordNew= new Seg_moduloModel();
    this.recordView= new Seg_moduloModel();
    this.voption=this.rutaActiva.snapshot.params['ope'];
    this.vmodcod=this.rutaActiva.snapshot.params['modcod'];
    this.recordView.cod_mod=this.vmodcod;

    if(this.voption === "V" || this.voption ==="D" ||
this.voption ==="E"){
  this.seg_moduloService.getId(this.recordView,(data)=>{
    console.log(data);
    this.recordView=Object.assign({},data["DATA"][0]);
    this.refreshobject();
    
  })
}
   }


  ngOnInit(): void {}
oncomBack():void{
  this.router.navigate(['/seg/mod'], { skipLocationChange: true });
}
  onReestrablecer():void{
      
      
      this.recordEdit= new Seg_moduloModel();
      this.recordNew= new Seg_moduloModel();
      this.recordView= new Seg_moduloModel();
      this.voption=this.rutaActiva.snapshot.params['ope'];
      this.vmodcod=this.rutaActiva.snapshot.params['modcod'];
      this.recordView.cod_mod=this.vmodcod;
      if(this.voption === "V" || this.voption ==="D" ||
  this.voption ==="E"){
    this.seg_moduloService.getId(this.recordView,(data)=>{
      console.log(data);
      this.recordView=Object.assign({},data["DATA"][0]);
      this.refreshobject();
      
    })
  }
  }
  onSave():void{
    if(this.voption === "N"){
      this.seg_moduloService.insert(this.recordEdit, (data) => {
        
        if(data["ESTADO"]){
          this.msgservice.opeSuccesTModal("hola moises");
        }else{
          this.msgservice.opeErrorModal();
        }
      })
    } else if (this.voption === "E"){
      this.seg_moduloService.update(this.recordEdit, (data) => {
        if(data["ESTADO"]){
          this.msgservice.openGenericModal("himoy","hola","error");
        }else{
          this.msgservice.opeErrorModal();
        }
      })
    } else if (this.voption === "D"){
      this.seg_moduloService.delete(this.recordEdit, (data) => {
        if(data["ESTADO"]){
          this.msgservice.opeDeleteModal();
        }else{
          this.msgservice.opeErrorModal();
        }
      })
    }
    
  }

  refreshobject() {
    if (this.voption === "N") {
      this.recordNew = new Seg_moduloModel();
      this.recordEdit = new Seg_moduloModel();
      this.recordEdit = Object.assign({}, this.recordNew);
    } else {
      this.recordEdit = new Seg_moduloModel();
      this.recordEdit = Object.assign({}, this.recordView);
    }
  }

  onInputChange(event: any, field: string): void {
    console.log(field);
    console.log(event);
    this.recordEdit[field] = event.target ? event.target.value : event.value;
    console.log(this.recordEdit);
  }

}
