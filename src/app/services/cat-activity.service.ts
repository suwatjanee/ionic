import { Injectable } from '@angular/core'; 
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'  //อิงมาจากrootหน้าแรก
})
export class CatActivityService {
  apiUrl : string ="http://localhost/2.History/process/crud_cateactivity.php"; //Url ที่จะคอลไป

  constructor(public http: HttpClient) {  //ถูกทำงานก่อนอันดับแรกเสมอ
   

   } 

   
   getCatAtivity(){
    const header = {'Content-Type': 'application/json'};
    let data = {
      'cmd' : 'select'
    }
    return this.http.post(this.apiUrl,data, {headers: header});
  }

  get(his_id : any){
    const header = {'Content-Type': 'application/json'};
    let data = {
      'cmd' : 'selectone',
      'his_id' : his_id
    }
    return this.http.post(this.apiUrl,data, {headers: header});
  }
  
  insert( his_name: string, his_pirce: any){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'insert',
      'his_name': his_name,
      'his_pirce': his_pirce
      
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }

  del( his_id : any){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'delete',
      'his_id' : his_id
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }
  
  edit( his_id: any , his_name: string, his_pirce:any	){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'edit',
      'his_id' : his_id ,
      'his_name': his_name,
      'his_pirce': his_pirce,
     
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }
}
