import { Injectable } from '@angular/core';

import Swal from 'sweetalert2';

@Injectable()
export class SwMsgservice{
    constructor(){

    }
    public opeSuccesModal(){
        Swal.fire({
            title: "Informacion",
            text: "Operacion ejecutada exitosamente",
            icon: "success"
          });

    }

    public opeSuccesTModal(message:any){
        Swal.fire({
            title: "Informacion",
            text: message,
            icon: "success"
          });

    }

    public openGenericModal (title:any,message:any, icon:any){
        Swal.fire({
            title: title,
            text: message,
            icon: icon
          });
      }

    public opeErrorModal(){
        Swal.fire({
            title: "ifnormacinon",
            text: "La Operacion no pudo ser ejecutada, consulte al administrador",
            icon: "error"
          });
    }

    public opeDeleteModal(){
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
              });
            }
          });
    }
}