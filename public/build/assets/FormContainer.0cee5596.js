import{o as i,c as a,w as m,k as n,F as c,p,s as u,t as d,b as l,v as f,l as v,u as y,n as F,y as h,O as T,a2 as g,T as w}from"./app.91faff10.js";import{_ as k}from"./AppLayout.019f9519.js";import _ from"./GeneralNotification.ca33d7aa.js";import C from"./FormPazienti.1bba31f4.js";import N from"./FormAmbulatori.05ffe270.js";import x from"./FormCalendario.39fae4e3.js";import z from"./FormMedici.f70c60e0.js";import $ from"./FormSocieta.5ba7566a.js";import B from"./FormAccettazioneMedsport.3e58f638.js";import D from"./FormImpostazioniSport.42bdfc52.js";import A from"./FormGestionePrestazioni.1efa21f1.js";import I from"./FormGestioneNumeratori.5944ac07.js";import M from"./FormBryntumCalendar.c4b9f236.js";import b from"./FormHome.34dfa780.js";import"./index.fc9ac9bc.js";import"./index.708a0cab.js";import"./ModalPaziente.6c0d45eb.js";import"./response.70bff4ea.js";import"./check-box.3b03f7e3.js";import"./check_box.bd4929f9.js";import"./select-box.9cc7c130.js";import"./select_box.e8817efd.js";import"./date-box.cf07a735.js";import"./date_box.745fde92.js";import"./number_box.976ffa07.js";import"./radio-group.6a7b6bf0.js";import"./text-area.ef96479a.js";import"./data_source.6be12e61.js";import"./data-grid.93ce6c9b.js";import"./draggable.67b3fe5e.js";import"./plugin-vue_export-helper.21dcd24c.js";import"./ModalAmbulatorio.53695a71.js";import"./number-box.75808b5b.js";import"./ModalPrenotazioneMedsport.9926e432.js";import"./ModalPrenotazioneAmbulatoriale.460da5c7.js";import"./ModalPrenotazioneMedsportSocieta.68a86766.js";import"./ModalSocietaSportiva.bfc086aa.js";import"./ModalNotaCalendario.643fdbc3.js";import"./ModalAssenzaCalendario.40f88721.js";import"./ModalImpostazioniCalendario.eaed0d81.js";import"./ModalConfermaEliminazione.65a2f8fa.js";import"./ModalMedico.c89bde99.js";import"./ModalSchedaMedsport.c778506d.js";import"./ModalRicercaPaziente.e8a98483.js";import"./ModalSport.7e488d29.js";import"./PrestazioniListinoMedsportTemplate.6162d8ec.js";import"./PrestazioniListinoAmbulatorialeTemplate.1e576689.js";import"./DettagliNumeratoreTemplate.174be4b6.js";const P={key:0,class:"-mb-px sm:flex hidden space-x-8","aria-label":"Tabs"},S=["onClick","aria-current"],j={key:1},O={key:0,class:"mr-4 border hover:bg-gray-200 bg-gray-100"},V={"aria-live":"assertive",class:"z-50 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-end sm:p-6"},G={class:"flex w-full flex-col items-center space-y-4 sm:items-end"},E={emits:["notify"],components:{FormPazienti:C,FormCalendario:x,FormAmbulatori:N,FormMedici:z,FormSocieta:$,FormAccettazioneMedsport:B,FormImpostazioniSport:D,FormGestionePrestazioni:A,FormGestioneNumeratori:I,FormHome:b,FormBryntumCalendar:M},data(){return{dati_tessera:null,activeTabs:[],currentTab:null,notifications:[],electronClient:!1}},mounted(){window.electron&&(window.electron.creaMenu(this.convertiPermessi(this.$page.props.user.permessi)),this.electronClient=!0),window.electron&&window.electron.openForm((e,t)=>{this.activateForm(t)}),window.electron&&window.electron.notificationsFromMain((e,t)=>{console.log(t),this.addNotification(t.type,t.title,t.text)})},methods:{activateForm(e){this.activeTabs.find(t=>t.name==e.name)||this.activeTabs.push(e),this.currentTab=e},destroyForm(e){this.activeTabs.splice(this.activeTabs.findIndex(t=>t.component===e),1),this.currentTab=this.activeTabs[this.activeTabs.length-1]},addNotification(e,t,s){this.notifications.push({show:!0,type:e,title:t,text:s})},dismissNotification(e){this.notifications.splice(this.notifications.findIndex(t=>t.id===e),1)},convertiPermessi(e){let t={};for(const[s,o]of Object.entries(e))t[s]=o;return t}}},Ot=Object.assign(E,{__name:"FormContainer",setup(e){return(t,s)=>(i(),a(k,{onActivateForm:t.activateForm,currentTab:t.currentTab},{navigazione:m(()=>{var o;return[t.electronClient?(i(),n("nav",P,[(i(!0),n(c,null,p(t.activeTabs,(r,H)=>(i(),n("button",{onClick:L=>t.activateForm(r),key:r,class:u([r.component==t.currentTab.component?"border-indigo-500 text-indigo-600":"border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300","group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"]),"aria-current":r.current?"page":void 0},[(i(),a(d(r.icon),{class:u([r.component==t.currentTab.component?"text-indigo-500":"text-gray-400 group-hover:text-gray-500","-ml-0.5 mr-2 h-5 w-5"]),"aria-hidden":"true"},null,8,["class"])),l("span",null,f(r.name),1)],10,S))),128))])):(i(),n("div",j,f((o=t.currentTab)==null?void 0:o.name),1))]}),bottoneChiusuraForm:m(()=>[t.currentTab?(i(),n("button",O,[v(y(F),{class:"text-black h-7 w-7",onClick:s[0]||(s[0]=o=>t.destroyForm(t.currentTab.component))})])):h("",!0)]),default:m(()=>[(i(!0),n(c,null,p(t.activeTabs,o=>T((i(),a(d(o.component),{key:"active-component-"+o.name,onNotify:t.addNotification},null,40,["onNotify"])),[[g,o.name==t.currentTab.name]])),128)),t.activeTabs.length===0?(i(),a(b,{key:0})):h("",!0),l("div",V,[l("div",G,[(i(!0),n(c,null,p(t.notifications,o=>(i(),a(w,{key:o,"enter-active-class":"transform ease-out duration-300 transition","enter-from-class":"translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2","enter-to-class":"translate-y-0 opacity-100 sm:translate-x-0","leave-active-class":"transition ease-in duration-100","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:m(()=>[v(_,{data:o,timeout:3,onDismiss:t.dismissNotification},null,8,["data","onDismiss"])]),_:2},1024))),128))])])]),_:1},8,["onActivateForm","currentTab"]))}});export{Ot as default};
