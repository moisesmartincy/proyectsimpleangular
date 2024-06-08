import { Component, ElementRef,OnInit, ViewChild, ChangeDetectorRef } from '@angular/core';

import { Seg_moduloModel } from './../../../core/seg/seg_modulo/model/Seg_modulo.model';
import { Seg_moduloService } from './../../../core/seg/seg_modulo/service/Seg_modulo.service';
@Component({
  selector: 'app-modulo-listar',
  templateUrl: './modulo.component.html',
  styleUrls: ['./../common/common.css']
})
export class ModuloListComponent implements OnInit {

  constructor(private seg_moduloService:Seg_moduloService) { 

    this.seg_moduloService.getAll(null, data => {
     console.log(data);
    });
  }

  ngOnInit() {
  }

}