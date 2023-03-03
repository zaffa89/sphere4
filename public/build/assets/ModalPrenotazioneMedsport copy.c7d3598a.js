import{d as i,ar as $,o as p,c as h,u as s,H as C,w as u,f as l,I as A,J as S,_ as Y,e as c,U as F,a as U,B as d,C as v,al as B}from"./app.ff11f486.js";import V from"./ModalPaziente.b52dacaa.js";import{g as I,b4 as E,b5 as f}from"./check_box.a3b61762.js";import{D as m}from"./select-box.667df2dc.js";import{_ as H}from"./date-box.e1bfc4ae.js";import{_ as L}from"./number-box.598f1659.js";import{D as q}from"./text-area.170595cb.js";import"./data_source.9d9969f5.js";import{a as N,i as T}from"./response.70bff4ea.js";import"./check-box.3d57f674.js";import"./radio-group.9499d89b.js";import"./select_box.d813d406.js";import"./date_box.9adfc2d5.js";import"./number_box.ef233ea9.js";const K=i("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),O={class:"fixed inset-0 z-50 overflow-y-auto"},R={class:"flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"},J={key:0,class:"flex justify-center items-center"},Z=i("svg",{class:"animate-spin h-5 w-5 text-gray-900",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},[i("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"}),i("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"})],-1),G=[Z],Q={key:1},W={class:"flex flex-col gap-3"},X={class:"grid grid-cols-1 sm:grid-cols-2 gap-3"},ee={class:"flex flex-col gap-1"},te=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Data e ora prenotazione")])],-1),ie={key:2,class:"text-red-500 text-sm"},ae=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Paziente / Atleta")])],-1),se={class:"flex items-center gap-3"},oe={class:"flex flex-col gap-1"},ne={key:3},le=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Listino e sport")])],-1),re={class:"flex flex-col gap-1"},de=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Dettagli paziente")])],-1),pe={key:0,class:"flex justify-center items-center h-full"},ce={key:1},me={class:"flex justify-between pt-1"},ue=i("span",{class:"text-sm text-gray-500"},"Nome: ",-1),ve={class:"text-sm font-medium text-gray-900 capitalize"},he={class:"flex justify-between pt-1"},fe=i("span",{class:"text-sm text-gray-500"},"Cognome: ",-1),ze={class:"text-sm font-medium text-gray-900 capitalize"},ge={class:"flex justify-between pt-1"},_e=i("span",{class:"text-sm text-gray-500"},"ragsoc: ",-1),ye={class:"text-sm font-medium text-gray-900 capitalize"},be={class:"flex justify-between pt-1"},xe=i("span",{class:"text-sm text-gray-500"},"Sesso: ",-1),we={class:"text-sm font-medium text-gray-900 capitalize"},je={class:"flex justify-between pt-1"},Pe=i("span",{class:"text-sm text-gray-500"},"Data di nascita: ",-1),De={class:"text-sm font-medium text-gray-900 capitalize"},ke={class:"flex justify-between pt-1"},Se=i("span",{class:"text-sm text-gray-500"},"Nato a: ",-1),Ie={class:"text-sm font-medium text-gray-900 uppercase"},Ee={class:"flex justify-between pt-1"},Ne=i("span",{class:"text-sm text-gray-500"},"Codice fiscale: ",-1),Te={class:"text-sm font-medium text-gray-900 uppercase"},Me={class:"flex justify-between pt-1"},$e=i("span",{class:"text-sm text-gray-500"},"Residenza: ",-1),Ce={class:"text-sm font-medium text-gray-900 uppercase"},Ae={class:"flex justify-between pt-1"},Ye=i("span",{class:"text-sm text-gray-500"},"Indirizzo: ",-1),Fe={class:"text-sm text-gray-900 uppercase text-right"},Ue={class:"flex justify-between pt-1"},Be=i("span",{class:"text-sm text-gray-500"},"Cellulare: ",-1),Ve={class:"text-sm font-medium text-gray-900 capitalize"},He={class:"flex justify-between pt-1"},Le=i("span",{class:"text-sm text-gray-500"},"Fisso: ",-1),qe={class:"text-sm font-medium text-gray-900 capitalize"},Ke={class:"flex justify-between pt-1"},Oe=i("span",{class:"text-sm text-gray-500"},"Indirizzo Email: ",-1),Re={class:"text-sm font-medium text-gray-900 capitalize"},Je=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Dettagli Societ\xE0 Sportiva")])],-1),Ze={key:2,class:"flex justify-center items-center h-full"},Ge={key:3},Qe={class:"flex justify-between pt-1"},We=i("span",{class:"text-sm text-gray-500"},"Ragione sociale: ",-1),Xe={class:"text-sm font-medium text-gray-900 capitalize"},et=i("div",{class:"relative"},[i("div",{class:"absolute inset-0 flex items-center","aria-hidden":"true"},[i("div",{class:"w-full border-t border-gray-300"})]),i("div",{class:"relative flex justify-center"},[i("span",{class:"bg-white px-2 text-sm text-gray-500"},"Altro")])],-1),tt={class:"grid grid-cols-1 pt-4"},it={class:"mt-5 sm:mt-6 flex flex-col sm:flex-row sm:justify-around gap-4"},at=i("button",{class:"opacity-0 absolute bottom-0"},null,-1),st={props:["appointmentData"],emits:["update","store","close"],data(){return{fetching:!1,saving:!1,errors:null,now:dayjs().format("YYYY-MM-DD HH:mm"),struttura:[],prenotazione:[],listini_agonistici:[],listini_non_agonistici:[],colori:[],elenco_sport:[],modalPazienteId:null,datiTesseraSanitaria:null,avviso_paziente:null}},computed:{disabledElement(){return this.prenotazione.accettata||this.saving},open(){return this.appointmentData!==null},sezioneVisita(){return this.prenotazione.sezione_visita},ambulatoriPrenotabili(){return this.struttura.ambulatori},mediciPrenotabili(){var r;let t=[];return this.$page.props.settings.limita_medici_con_orario_medico.value&&!((r=this.appointmentData)!=null&&r.nascosta)?this.struttura.orari_medici.forEach(e=>{dayjs(this.prenotazione.data_inizio,"YYYY-MM-DD").isSame(e.data_inizio,"day")&&e.ambulatorio_id==this.prenotazione.ambulatorio_id&&t.push(this.medici.find(a=>a.id==e.medico_id))}):t=this.medici,[...new Set(t.map(e=>e))]},listiniAgonisticiFiltratiPerSport(){var o;let t=this.prenotazione.visita.sport_id&&this.prenotazione.visita.sport_id!=0?this.listini_agonistici.filter(r=>r.tipo_visita==this.elenco_sport.find(e=>e.id===this.prenotazione.visita.sport_id).tipo_visita):this.listini_agonistici.filter(r=>r.agonistico);return this.listini_agonistici.find(r=>r.id===this.prenotazione.visita.listino_id)&&(this.prenotazione.visita.listino_id=(o=t[0])==null?void 0:o.id),t},listiniNonAgonistici(){return this.listini_non_agonistici},orarioInOrarioMedico(){return this.struttura.orari_medici.find(t=>dayjs(this.prenotazione.data_inizio).isBetween(t.data_inizio,t.data_fine,null,"[]")&&t.ambulatorio_id==this.prenotazione.ambulatorio_id&&t.medico_id==this.prenotazione.medico_id)}},watch:{"prenotazione.ambulatorio_id":{handler(t,o){o&&o!==t&&(this.prenotazione.medico_id=null)}}},async created(){this.appointmentData.id?(this.fetching=!0,await axios.get(`api/sphere/medsport/prenotazione/edit/${this.appointmentData.id}`).then(t=>{this.prenotazione=t.data.prenotazione,this.prenotazione.durata=dayjs(t.data.prenotazione.data_fine).diff(t.data.prenotazione.data_inizio,"minute"),this.elenco_sport=t.data.elenco_sport,this.struttura=t.data.struttura,this.listini_agonistici=t.data.listini_agonistici,this.listini_non_agonistici=t.data.listini_non_agonistici,this.medici=t.data.medici}).catch(t=>{this.fetching=!1,this.$emit("close")}),this.fetching=!1):(this.fetching=!0,await axios.post("api/sphere/medsport/prenotazione/create",this.appointmentData).then(t=>{this.prenotazione=t.data.prenotazione,this.prenotazione.durata=dayjs(t.data.prenotazione.data_fine).diff(t.data.prenotazione.data_inizio,"minute"),this.struttura=t.data.struttura,this.listini_agonistici=t.data.listini_agonistici,this.listini_non_agonistici=t.data.listini_non_agonistici,this.elenco_sport=t.data.elenco_sport,this.medici=t.data.medici}).catch(t=>{this.fetching=!1,this.$emit("close")}),this.fetching=!1)},methods:{apriModalNuovoPaziente(t=null){this.modalPazienteId="new",this.datiTesseraSanitaria=t},apriModalModificaPaziente(){this.modalPazienteId=this.prenotazione.visita.paziente_id},cambiaPaziente(t){this.prenotazione.visita.paziente_id=t.id,this.prenotazione.visita.paziente=t,this.modalPazienteId=null,this.$refs.selectboxPaziente.instance.repaint()},formatDataNascita(t){return dayjs(t).format("DD/MM/YYYY")},errorFor(t){return!!(this.errors!==null&&this.errors[t])},pazienteItemTemplate(t){let o=t.data_nascita?dayjs(t.data_nascita).format("DD/MM/YYYY"):"N/A";return'<div class="flex justify-between"><span class="truncate capitalize">'+t.ragione_sociale+"</span><span>"+o+"</span></div>"},societaItemTemplate(t){return'<div class="flex justify-between"><span class="truncate">'+t.ragione_sociale+"</span></div>"},ambulatorioItemTemplate(t){return'<div class="flex justify-between"><span class="truncate">'+t.nome+"</span></div>"},medicoItemTemplate(t){return'<div class="flex justify-between"><span class="truncate">'+t.ragione_sociale+"</span></div>"},sportItemTemplate(t){return'<div class="flex justify-between"><span class="uppercase truncate">'+t.nome+"</span><span>"+t.tipo_visita+"</span></div>"},listinoItemTemplate(t){return'<div class="flex justify-between"><span class="truncate">'+t.nome+"</span><span>"+t.codice+"</span></div>"},coloriTemplate(t){return'<div class="flex capitalize font-bold text-['+t.codice+']">'+t.nome+"</div>"},selezionaPaziente(t){this.prenotazione.visita.paziente=t.selectedItem},selezionaSocieta(t){this.prenotazione.societa_sportiva=t.selectedItem},salvaPrenotazione(){this.prenotazione.id?this.update():this.store()},async update(){this.saving=!0,this.errors=null,await axios.put(`api/sphere/prenotazione/${this.prenotazione.id}`,this.prenotazione).then(t=>{this.$emit("update",t.data)}).catch(t=>{N(t)&&(this.errors=t.response.data.errors),this.saving=!1}),this.saving=!1},async store(){this.errors=null,this.saving=!0,await axios.post("api/sphere/medsport/prenotazione/store",this.prenotazione).then(t=>{this.$emit("store",t.data)}).catch(t=>{N(t)&&(this.errors=t.response.data.errors),this.saving=!1}),this.saving=!1},calcolaAnni(t){const o=dayjs(t);return dayjs().diff(o,"year")},letturaTessera(){var t;(t=window.electron)!=null||window.electron.leggiTessera().then(o=>{o=="no tessera"?console.log("nessuna tessera inserita"):axios.get(`api/sphere/cerca-tramite-codice-fiscale/${o.codice_fiscale}`).then(r=>{this.cambiaPaziente(r.data)}).catch(r=>{T(r)?(console.log("nessun paziente trovato con codice fiscale "+o.codice_fiscale),this.apriModalNuovoPaziente(o)):console.log("errore controllo codice fiscale")})})},async cercaTramiteCodiceFiscale(t){await axios.get(`api/sphere/cerca-tramite-codice-fiscale/${t}`).then(o=>{var r;o.data.id!==((r=this.paziente)==null?void 0:r.id)&&(this.paziente_doppio_trovato=o.data)}).catch(o=>{T(o)&&(this.paziente_doppio_trovato=null)})}}},_t=Object.assign(st,{__name:"ModalPrenotazioneMedsport copy",setup(t){const o=new I({store:new E({key:"id",useDefaultSearch:!1,load(e){if(e.searchValue)return axios.get(`api/sphere/ricerca-paziente/${e.searchValue}`).then(a=>a.data).catch(a=>{throw new Error("Errore caricamento")})},byKey:e=>axios.get(`api/sphere/paziente/${e}`).then(a=>a.data).catch(a=>{throw new Error("Errore caricamento localit\xE0")}),errorHandler:e=>{console.log(e.message)}})}),r=new I({store:new E({key:"id",useDefaultSearch:!1,load(e){if(e.searchValue)return axios.get(`api/sphere/ricerca-societa/${e.searchValue}`).then(a=>a.data).catch(a=>{throw new Error("Errore caricamento")})},byKey:e=>axios.get(`api/sphere/societa-sportiva/${e}`).then(a=>a.data).catch(a=>{throw new Error("Errore caricamento localit\xE0")}),errorHandler:e=>{console.log(e.message)}})});return(e,a)=>{const M=$("AlertErrors");return p(),h(s(C),{as:"template",show:e.open},{default:u(()=>[l(s(A),{as:"div",class:"relative z-50"},{default:u(()=>[l(s(S),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:u(()=>[K]),_:1}),i("div",O,[i("div",R,[l(s(S),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:u(()=>[l(s(Y),{class:"relative transform rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6"},{default:u(()=>{var z,g,_,y,b,x,w,j,P,D,k;return[e.fetching?(p(),c("div",J,G)):(p(),c("div",Q,[l(s(F),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900 text-center"},{default:u(()=>[U(d(e.prenotazione.id?"Modifica prenotazione medsport":"Nuova prenotazione medsport"),1)]),_:1}),i("div",W,[i("div",X,[i("div",ee,[te,l(s(H),{value:e.prenotazione.data_inizio,"onUpdate:value":a[0]||(a[0]=n=>e.prenotazione.data_inizio=n),min:e.now,type:"datetime","is-valid":!e.errorFor("data_inizio"),label:"Data e ora della visita",disabled:e.disabledElement},null,8,["value","min","is-valid","disabled"]),(z=t.appointmentData)!=null&&z.nascosta?v("",!0):(p(),h(s(L),{key:0,value:e.prenotazione.durata,"onUpdate:value":a[1]||(a[1]=n=>e.prenotazione.durata=n),placeholder:"Durata visita in minuti","show-spin-buttons":!0,"is-valid":!e.errorFor("durata"),label:"Durata della visita",disabled:e.disabledElement},null,8,["value","is-valid","disabled"])),(g=t.appointmentData)!=null&&g.nascosta?v("",!0):(p(),h(s(m),{key:1,value:e.prenotazione.ambulatorio_id,"onUpdate:value":a[2]||(a[2]=n=>e.prenotazione.ambulatorio_id=n),"data-source":e.ambulatoriPrenotabili,"value-expr":"id","display-expr":"nome",label:"Ambulatorio","label-mode":"static",placeholder:"---","no-data-text":"Nessun ambulatorio selezionabile",disabled:e.ambulatoriPrenotabili.length===0||e.disabledElement,"drop-down-options":{maxHeight:"200px"},"item-template":e.ambulatorioItemTemplate,"is-valid":!e.errorFor("ambulatorio_id")},null,8,["value","data-source","disabled","item-template","is-valid"])),l(s(m),{value:e.prenotazione.medico_id,"onUpdate:value":a[3]||(a[3]=n=>e.prenotazione.medico_id=n),"data-source":e.mediciPrenotabili,"value-expr":"id","search-enabled":!0,"display-expr":"ragione_sociale",label:"Medico","label-mode":"static",placeholder:"---","no-data-text":"Nessun medico selezionabile",disabled:e.mediciPrenotabili.length===0||e.disabledElement,"drop-down-options":{maxHeight:"200px"},"item-template":e.medicoItemTemplate,"is-valid":!e.errorFor("medico_id")},null,8,["value","data-source","disabled","item-template","is-valid"]),!e.orarioInOrarioMedico&&e.$page.props.settings.avviso_presenza_orario_medico.value?(p(),c("p",ie," Medico non disponibile nell'ambulatorio/orario selezionato ")):v("",!0),ae,i("div",se,[i("div",oe,[l(s(f),{width:"100%",text:"Leggi Tessera Sanitaria",type:"normal",icon:"find","styling-mode":"contained",disabled:!1,onClick:e.letturaTessera},null,8,["onClick"]),l(s(f),{id:"saveButton",width:"100%",text:"Nuovo paziente",icon:"plus",type:"normal","styling-mode":"contained",disabled:!1,onClick:a[4]||(a[4]=n=>e.apriModalNuovoPaziente())})]),l(s(f),{id:"saveButton",width:"100%",height:"100%",text:"Apri paziente",icon:"activefolder",type:"normal","styling-mode":"contained",disabled:!e.prenotazione.visita.paziente_id,onClick:e.apriModalModificaPaziente},null,8,["disabled","onClick"])]),l(s(m),{ref:"selectboxPaziente",value:e.prenotazione.visita.paziente_id,"onUpdate:value":a[5]||(a[5]=n=>e.prenotazione.visita.paziente_id=n),"data-source":s(o),"value-expr":"id","display-expr":"ragione_sociale","search-enabled":!0,"search-timeout":500,label:"Paziente","label-mode":"static",placeholder:"Cognome e Nome","no-data-text":"Nessuna anagrafica trovata",disabled:e.disabledElement,"drop-down-options":{maxHeight:"200px"},"item-template":e.pazienteItemTemplate,"on-selection-changed":e.selezionaPaziente,"is-valid":!e.errorFor("visita.paziente_id"),"open-on-field-click":!1,"min-search-length":2},null,8,["value","data-source","disabled","item-template","on-selection-changed","is-valid"]),e.avviso_paziente?(p(),c("div",ne," AVVISO PAZIENTE ")):v("",!0),le,l(s(m),{value:e.prenotazione.visita.sport_id,"onUpdate:value":a[6]||(a[6]=n=>e.prenotazione.visita.sport_id=n),label:"Sport praticato","data-source":e.elenco_sport,"value-expr":"id","display-expr":"nome","search-enabled":!0,"item-template":e.sportItemTemplate,"is-valid":!e.errorFor("visita.sport_id"),disabled:e.disabledElement,"no-data-text":"Nessuno sport trovato"},null,8,["value","data-source","item-template","is-valid","disabled"]),l(s(m),{value:e.prenotazione.visita.listino_id,"onUpdate:value":a[7]||(a[7]=n=>e.prenotazione.visita.listino_id=n),"search-enabled":!0,label:"Listino Agonistico","data-source":e.listiniAgonisticiFiltratiPerSport,"value-expr":"id","display-expr":"nome","item-template":e.listinoItemTemplate,"is-valid":!e.errorFor("visita.listino_id"),disabled:e.disabledElement,"no-data-text":"Nessun listino trovato"},null,8,["value","data-source","item-template","is-valid","disabled"]),l(s(m),{value:e.prenotazione.visita.listino_id,"onUpdate:value":a[8]||(a[8]=n=>e.prenotazione.visita.listino_id=n),"search-enabled":!0,label:"Listino non Agonistico","data-source":e.listini_non_agonistici,"value-expr":"id","display-expr":"nome","item-template":e.listinoItemTemplate,"is-valid":!e.errorFor("visita.listino_id"),disabled:e.disabledElement,"no-data-text":"Nessun listino trovato"},null,8,["value","data-source","item-template","is-valid","disabled"]),l(s(m),{value:e.prenotazione.societa_id,"onUpdate:value":a[9]||(a[9]=n=>e.prenotazione.societa_id=n),"data-source":s(r),"value-expr":"id","display-expr":"ragione_sociale","search-enabled":!0,"search-timeout":500,label:"Societ\xE0 sportiva","label-mode":"static","no-data-text":"Nessuna societ\xE0 trovata",disabled:e.disabledElement,"drop-down-options":{maxHeight:"200px"},"on-selection-changed":e.selezionaSocieta,"is-valid":!e.errorFor("societa_id"),"open-on-field-click":!1,"min-search-length":2},null,8,["value","data-source","disabled","on-selection-changed","is-valid"])]),i("div",re,[de,e.prenotazione.visita.paziente?(p(),c("div",ce,[i("div",me,[ue,i("span",ve,d(e.prenotazione.visita.paziente.nome),1)]),i("div",he,[fe,i("span",ze,d(e.prenotazione.visita.paziente.cognome),1)]),i("div",ge,[_e,i("span",ye,d(e.prenotazione.visita.paziente.ragione_sociale),1)]),i("div",be,[xe,i("span",we,d(e.prenotazione.visita.paziente.sesso),1)]),i("div",je,[Pe,i("span",De,d(s(B)(e.prenotazione.visita.paziente.data_nascita))+" ( "+d(e.calcolaAnni(e.prenotazione.visita.paziente.data_nascita))+" anni ) ",1)]),i("div",ke,[Se,i("span",Ie,d((_=e.prenotazione.visita.paziente.localita_nascita)==null?void 0:_.nome)+" ( "+d((y=e.prenotazione.visita.paziente.localita_nascita)==null?void 0:y.sigla_provincia)+" )",1)]),i("div",Ee,[Ne,i("span",Te,d((b=e.prenotazione.visita.paziente)==null?void 0:b.codice_fiscale),1)]),i("div",Me,[$e,i("span",Ce,d((x=e.prenotazione.visita.paziente.localita_residenza)==null?void 0:x.nome)+" ( "+d((w=e.prenotazione.visita.paziente.localita_residenza)==null?void 0:w.sigla_provincia)+" )",1)]),i("div",Ae,[Ye,i("span",Fe,d((j=e.prenotazione.visita.paziente)==null?void 0:j.indirizzo),1)]),i("div",Ue,[Be,i("span",Ve,d((P=e.prenotazione.visita.paziente)==null?void 0:P.telefono),1)]),i("div",He,[Le,i("span",qe,d((D=e.prenotazione.visita.paziente)==null?void 0:D.telefono_fisso),1)]),i("div",Ke,[Oe,i("span",Re,d((k=e.prenotazione.visita.paziente)==null?void 0:k.email),1)])])):(p(),c("div",pe," Nessun paziente selezionato ")),Je,e.prenotazione.societa_sportiva?(p(),c("div",Ge,[i("div",Qe,[We,i("span",Xe,d(e.prenotazione.societa_sportiva.ragione_sociale),1)])])):(p(),c("div",Ze," Nessuna societ\xE0 selezionata "))])]),et,i("div",tt,[l(s(q),{value:e.prenotazione.note,"onUpdate:value":a[10]||(a[10]=n=>e.prenotazione.note=n),placeholder:"Note prenotazione",spellcheck:!1},null,8,["value"])])]),i("div",it,[l(s(f),{width:"100%",text:"Chiudi",type:"danger",icon:"close","styling-mode":"contained",disabled:e.saving,onClick:a[11]||(a[11]=n=>e.$emit("close"))},null,8,["disabled"]),l(s(f),{id:"saveButton",width:"100%",text:e.saving?"Salvataggio...":e.disabledElement?"Prenotazione gi\xE0 accettata":"Salva prenotazione",icon:"save",type:"success","styling-mode":"contained",disabled:e.disabledElement||e.saving,onClick:a[12]||(a[12]=n=>e.salvaPrenotazione())},null,8,["text","disabled"])])]))]}),_:1})]),_:1})])]),at,e.errors?(p(),h(M,{key:0,errors:e.errors},null,8,["errors"])):v("",!0),e.modalPazienteId?(p(),h(V,{key:1,"paziente-id":e.modalPazienteId,"dati-tessera":e.datiTesseraSanitaria,onClose:a[13]||(a[13]=z=>e.modalPazienteId=null),onStore:e.cambiaPaziente,onUpdate:e.cambiaPaziente},null,8,["paziente-id","dati-tessera","onStore","onUpdate"])):v("",!0)]),_:1})]),_:1},8,["show"])}}});export{_t as default};
