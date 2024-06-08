import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { Observable, Subscriber } from 'rxjs';
import { tap, map, filter } from 'rxjs/operators';
import { Seg_aplicacionModel } from '../model/seg_aplicacion.model';
import { PathConfig } from 'app/core/path.config';

@Injectable()
export class Seg_aplicacionService {
    private path: PathConfig;
    private restUrl: string;
    constructor(private http: HttpClient) {
        this.path = new PathConfig();
        this.restUrl = this.path.modulo + '/controller/Seg_aplicacionController.php';
    }
    public getAllPage(searchfilter: any, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('ope', 'filterSearch');
        params = params.append('page', searchfilter.page);
        params = params.append('filter', searchfilter.searchfor);
        params = params.append('cod_mod', searchfilter.cod_mod);
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
    public getId(filter: Seg_aplicacionModel, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('ope', 'filterId');
        params = params.append('cod_apl', filter.cod_mod);
        return this.http.get(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);

    }
    public insert(record: Seg_aplicacionModel, action: (data: any) => any, actionError?: (data: any) => any) {
        this.http.post(this.restUrl, record).subscribe(
            data => action(data),
            error => error);

    }
    public update(record: Seg_aplicacionModel, action: (data: any) => any, actionError?: (data: any) => any) {
        this.http.put(this.restUrl, record).subscribe(
            data => action(data),
            error => error);

    }
    public delete(record: Seg_aplicacionModel, action: (data: any) => any, actionError?: (data: any) => any) {
        let params = new HttpParams();
        params = params.append('cod_apl', record.cod_mod);
        this.http.delete(this.restUrl, { params: params }).subscribe(
            data => action(data),
            error => error);

    }
}