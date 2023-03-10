import{o as s,e as a,d as i,a as d,B as l}from"./app.d1109b7e.js";import{_ as g}from"./plugin-vue_export-helper.21dcd24c.js";const c={data(){return{dati_tessera:null,firma:null}},methods:{letturaTessera(){window.electron&&window.electron.leggiTessera().then(n=>{this.dati_tessera=n,console.log(this.dati_tessera)})},apriAllegati(){window.electron&&window.electron.apriAllegati(4001)},generaCertificatoNonAgonistico(){window.electron.generaCertificatoNonAgonistico(4669,4001)},generaCertificatoGiallo(){window.electron.generaCertificatoAgonisticoGiallo(4669,4001)},generaCertificatoRosso(){window.electron.generaCertificatoAgonisticoRosso(4669,4001)},generaSchedaAtleta(){window.electron.generaSchedaAtleta(4669,4001)},anteprimaCertificato(){window.electron.anteprimaCertificatoAgonisticoGiallo(1339)},leggiFirma(){window.electron&&window.electron.leggiFirma().then(n=>{this.firma="data:image/jpg;base64,"+n}).catch(n=>console.log(n))}}},f={class:"grid grid-cols-2 gap-4"},u={class:"flex flex-col border bg-white p-4"},m={class:"flex flex-col gap-2 border bg-white p-4"},b={class:"flex flex-col border bg-white p-4"},w=["src"],p={class:"flex flex-col border bg-white p-4"};function x(n,e,h,C,r,t){return s(),a("div",f,[i("div",u,[i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[0]||(e[0]=(...o)=>t.letturaTessera&&t.letturaTessera(...o))}," Leggi tessera sanitaria "),d(" "+l(r.dati_tessera),1)]),i("div",m,[i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[1]||(e[1]=(...o)=>t.generaCertificatoNonAgonistico&&t.generaCertificatoNonAgonistico(...o))}," genera certificato "),i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[2]||(e[2]=(...o)=>t.generaCertificatoGiallo&&t.generaCertificatoGiallo(...o))}," genera giallo "),i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[3]||(e[3]=(...o)=>t.generaCertificatoRosso&&t.generaCertificatoRosso(...o))}," genera rosso "),i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[4]||(e[4]=(...o)=>t.generaSchedaAtleta&&t.generaSchedaAtleta(...o))}," genera scheda ")]),i("div",b,[i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[5]||(e[5]=(...o)=>t.anteprimaCertificato&&t.anteprimaCertificato(...o))}," leggiFirma "),i("img",{src:r.firma},null,8,w)]),i("div",p,[i("button",{type:"button",class:"w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:e[6]||(e[6]=(...o)=>t.apriAllegati&&t.apriAllegati(...o))}," Apri allegati zaffa ( locale ) ")])])}var v=g(c,[["render",x]]);export{v as default};