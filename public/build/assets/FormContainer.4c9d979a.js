import{o,c as a,w as s,e as r,F as m,y as c,n as l,A as f,d as p,B as y,f as b,u as _,C as g,D as N,Z as z,T as B}from"./app.d1109b7e.js";import{A as $}from"./AppLayout.13956c29.js";import{c as A,d as D}from"./index.38076540.js";import I from"./GeneralNotification.8eb8c975.js";import T from"./FormPazienti.d23de344.js";import P from"./FormAmbulatori.39ecbcfc.js";import w from"./FormCalendario.6144649f.js";import M from"./FormMedici.6d4930d6.js";import S from"./FormSocieta.75b69030.js";import F from"./FormAccettazioneMedsport.5147f498.js";import j from"./FormImpostazioniSport.76e70632.js";import x from"./FormGestionePrestazioni.cfcdeffd.js";import k from"./FormGestioneNumeratori.fd1d05ab.js";import u from"./FormBryntumCalendar.3046f778.js";import h from"./FormHome.91f53faf.js";import"./plugin-vue_export-helper.21dcd24c.js";import"./index.a564909e.js";import"./ModalPaziente.a0d0ef68.js";import"./response.70bff4ea.js";import"./check-box.40c13dc7.js";import"./check_box.f0a19422.js";import"./select-box.564c7aaa.js";import"./select_box.12d15f3d.js";import"./date-box.ccad8242.js";import"./date_box.7abd4f86.js";import"./number_box.9a624177.js";import"./radio-group.c30d16c3.js";import"./text-area.6c47c957.js";import"./data_source.e7896b86.js";import"./data-grid.23300702.js";import"./draggable.d22a0d73.js";import"./ModalAmbulatorio.789e0e1a.js";import"./number-box.2713ac2d.js";import"./ModalPrenotazioneMedsport.d1812a9a.js";import"./ModalPrenotazioneAmbulatoriale.424fb306.js";import"./ModalPrenotazioneMedsportSocieta.4e6169a3.js";import"./ModalSocietaSportiva.6f10af09.js";import"./ModalNotaCalendario.82926737.js";import"./ModalAssenzaCalendario.eb3da6a7.js";import"./ModalImpostazioniCalendario.293ae559.js";import"./ModalConfermaEliminazione.a72306f9.js";import"./ModalMedico.b292192f.js";import"./ModalSchedaMedsport.016bb609.js";import"./ModalRicercaPaziente.45588666.js";import"./ModalSport.105738a6.js";import"./PrestazioniListinoMedsportTemplate.afcd8902.js";import"./PrestazioniListinoAmbulatorialeTemplate.7cbe0926.js";import"./DettagliNumeratoreTemplate.4cae5745.js";const G={key:0,class:"-mb-px sm:flex hidden space-x-8","aria-label":"Tabs"},V=["onClick","aria-current"],H={key:1,class:"-mb-px sm:flex space-x-8 hidden","aria-label":"Tabs"},L=["onClick","aria-current"],O={key:0,class:"mr-4 border hover:bg-gray-200 bg-gray-100"},E={"aria-live":"assertive",class:"z-50 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-end sm:p-6"},U={class:"flex w-full flex-col items-center space-y-4 sm:items-end"},Z={emits:["notify"],components:{FormPazienti:T,FormCalendario:w,FormAmbulatori:P,FormMedici:M,FormSocieta:S,FormAccettazioneMedsport:F,FormImpostazioniSport:j,FormGestionePrestazioni:x,FormGestioneNumeratori:k,FormHome:h,FormBryntumCalendar:u,UserIcon:A},data(){return{dati_tessera:null,activeTabs:[{name:"Brytum",component:u,icon:null}],currentTab:{name:"Brytum",component:u,icon:null},notifications:[],electronClient:!1,browserTabs:[{name:"Home",component:h,icon:null},{name:"Calendario",component:w,icon:null},{name:"Brytum",component:u,icon:null},{name:"Accettazioni MS",component:F,icon:null},{name:"Pazienti",component:T,icon:null},{name:"Gestione Prestazioni",component:x,icon:null},{name:"Numeratori",component:k,icon:null}]}},mounted(){window.electron&&(window.electron.creaMenu(this.convertiPermessi(this.$page.props.user.permessi)),this.electronClient=!0),window.electron&&window.electron.openForm((n,e)=>{this.activateForm(e)}),window.electron&&window.electron.notificationsFromMain((n,e)=>{console.log(e),this.addNotification(e.type,e.title,e.text)})},methods:{activateForm(n){this.activeTabs.find(e=>e.component==n.component)||this.activeTabs.push(n),this.currentTab=n},destroyForm(n){this.activeTabs.splice(this.activeTabs.findIndex(e=>e.component===n),1),this.currentTab=this.activeTabs[this.activeTabs.length-1]},addNotification(n,e,i){this.notifications.push({show:!0,type:n,title:e,text:i})},dismissNotification(n){this.notifications.splice(this.notifications.findIndex(e=>e.id===n),1)},convertiPermessi(n){let e={};for(const[i,t]of Object.entries(n))e[i]=t;return e}}},Le=Object.assign(Z,{__name:"FormContainer",setup(n){return(e,i)=>(o(),a($,null,{navigazione:s(()=>[e.electronClient?(o(),r("nav",G,[(o(!0),r(m,null,c(e.activeTabs,(t,C)=>(o(),r("button",{onClick:d=>e.activateForm(t),key:t,class:l([t.component==e.currentTab.component?"border-indigo-500 text-indigo-600":"border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300","group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"]),"aria-current":t.current?"page":void 0},[(o(),a(f(t.icon),{class:l([t.component==e.currentTab.component?"text-indigo-500":"text-gray-400 group-hover:text-gray-500","-ml-0.5 mr-2 h-5 w-5"]),"aria-hidden":"true"},null,8,["class"])),p("span",null,y(t.name),1)],10,V))),128))])):(o(),r("nav",H,[(o(!0),r(m,null,c(e.browserTabs,(t,C)=>{var d,v;return o(),r("button",{onClick:q=>e.activateForm(t),key:t,class:l([t.component==((d=e.currentTab)==null?void 0:d.component)?"border-indigo-500 text-indigo-600":"border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300","group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"]),"aria-current":t.current?"page":void 0},[(o(),a(f(t.icon),{class:l([t.component==((v=e.currentTab)==null?void 0:v.component)?"text-indigo-500":"text-gray-400 group-hover:text-gray-500","-ml-0.5 mr-2 h-5 w-5"]),"aria-hidden":"true"},null,8,["class"])),p("span",null,y(t.name),1)],10,L)}),128))]))]),bottoneChiusuraForm:s(()=>[e.currentTab?(o(),r("button",O,[b(_(D),{class:"text-black h-7 w-7",onClick:i[0]||(i[0]=t=>e.destroyForm(e.currentTab.component))})])):g("",!0)]),default:s(()=>[(o(!0),r(m,null,c(e.activeTabs,t=>N((o(),a(f(t.component),{key:"active-component-"+t.component,onNotify:e.addNotification},null,40,["onNotify"])),[[z,t.component==e.currentTab.component]])),128)),e.activeTabs.length===0?(o(),a(h,{key:0})):g("",!0),p("div",E,[p("div",U,[(o(!0),r(m,null,c(e.notifications,t=>(o(),a(B,{key:t,"enter-active-class":"transform ease-out duration-300 transition","enter-from-class":"translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2","enter-to-class":"translate-y-0 opacity-100 sm:translate-x-0","leave-active-class":"transition ease-in duration-100","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:s(()=>[b(I,{data:t,timeout:3,onDismiss:e.dismissNotification},null,8,["data","onDismiss"])]),_:2},1024))),128))])])]),_:1}))}});export{Le as default};