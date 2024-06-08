export class Seg_aplicacionModel {
    cod_apl!: string;
    cod_apl_sup!: string;
    cod_mod!: string;
    dsc_apl!: string;
    obs_apl!: string;
    tpo_apl!: string;
    menu!: string;
    ayuda!: string;
    url!: string;
    target_tpo!: string;
    hr_ini!: string;
    ht_fin!: string;
    sw_vie!: boolean;
    sw_sab!: boolean;
    sw_dom!: boolean;
    sw_fer!: boolean;
    estado!: string;
    usu_cre!: string;
    fh_cre!: any;
    usu_mod!: string;
    fh_mod!: any;
    
    constructor() {
        this.cod_apl = '';
        this.cod_apl_sup = '';
        this.cod_mod = '';
        this.dsc_apl = '';
        this.obs_apl = '';
        this.tpo_apl = '';
        this.menu = '';
        this.ayuda = '';
        this.url = '';
        this.target_tpo = '';
        this.hr_ini = '';
        this.ht_fin = '';
        this.sw_vie = false;
        this.sw_sab = false;
        this.sw_dom = false;
        this.sw_fer = false;
        this.estado = '';
        this.usu_cre = '';
        this.fh_cre = null;
        this.usu_mod = '';
        this.fh_mod = null;
    }
}
