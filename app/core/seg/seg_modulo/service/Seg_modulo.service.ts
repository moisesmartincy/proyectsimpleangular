import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { Observable, Subscriber } from 'rxjs';
import { tap, map, filter } from 'rxjs/operators';
import { PathConfig } from './../../../path.config';
import { Seg_moduloModel } from './../model/Seg_modulo.model';
@Injectable()
export class Seg_moduloService {
    private path: PathConfig;
    private restUrl: string;
    constructor(private http: HttpClient) {
        this.path = new PathConfig();
        this.restUrl = this.path.modulo + '/controller/Seg_moduloController.php';
    }
    public getAllPage(searchfilter: any, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('ope', 'filterSearch');
        params = params.append('page', searchfilter.page);
        params = params.append('filter', searchfilter.searchfor);
        return this.http.get(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);
    }
    public getAll(searchfilter: any, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('ope', 'filterall');
        return this.http.get(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);
    }
    public getId(filter: Seg_moduloModel, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('ope', 'filterId');
        params = params.append('cod_mod', filter.cod_mod);
        return this.http.get(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);
    }
    public insert(record: Seg_moduloModel, action: (data: any) => any, actionError?: (data: any) => any) {
        this.http.post(this.restUrl, record).subscribe(
            data => action(data),
            error => error);
    }
    public update(record: Seg_moduloModel, action: (data: any) => any, actionError?: (data: any) => any) {
        this.http.put(this.restUrl, record).subscribe(
            data => action(data),
            error => error);
    }
    public delete(record: Seg_moduloModel, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('cod_mod', record.cod_mod);
        this.http.delete(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);
    }
}