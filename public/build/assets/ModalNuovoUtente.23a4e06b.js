import{d as e,o as r,c as v,u as a,H as b,w as n,f as l,I as x,J as c,_ as h,K as w,U as _,a as k,D as i,G as u,L as U,e as m,F as p,y as f,B as g,E as y}from"./app.e0b64a2d.js";const C=e("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),M={class:"fixed z-10 inset-0 overflow-y-auto"},V={class:"flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"},z={class:"mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100"},j={class:"mt-3 sm:mt-5"},D={class:"mt-2 flex flex-col gap-5"},$=e("label",{for:"email",class:"block text-sm font-medium text-gray-700"},"Indirizzo Email",-1),B={class:"mt-1"},N=e("p",{class:"mt-2 text-sm text-gray-500"}," Lasciare vuoto per generare un indirizzo casuale temporaneo. ",-1),S=e("label",{for:"username",class:"block text-sm font-medium text-gray-700"},"Username",-1),E={class:"mt-1"},L=e("label",{for:"password",class:"block text-sm font-medium text-gray-700"},"Password",-1),F={class:"mt-1"},I=e("p",{class:"mt-2 text-sm text-gray-500"},"Default: 'password'",-1),T=e("label",{for:"password_confirmation",class:"block text-sm font-medium text-gray-700"},"Conferma password",-1),q={class:"mt-1"},A=e("p",{class:"mt-2 text-sm text-gray-500"},"Default: 'password'",-1),G={class:"relative flex items-start"},H={class:"flex items-center h-5"},J=e("div",{class:"ml-3 text-sm"},[e("label",{for:"attivo",class:"font-medium text-gray-700"},"Attivo"),e("p",{class:"text-gray-500"})],-1),K=e("label",{for:"ruolo",class:"block text-sm font-medium text-gray-700"},"Ruolo",-1),O=["value"],P=e("p",{class:"mt-2 text-sm text-gray-500"},"Selezionando un ruolo, verranno precaricati i permessi relativi al ruolo selezionato. Dopo la creazione sar\xE0 possibile aggiungere o togliere i permessi a questo utente.",-1),R=e("label",{for:"medico",class:"block text-sm font-medium text-gray-700"},"Medico",-1),Q=e("option",{value:null},null,-1),W=["value"],X=e("p",{class:"mt-2 text-sm text-gray-500"},"Sono elencati solo i medici non assegnati ad alcun utente sphere",-1),Y={class:"mt-5 sm:mt-6"},Z={class:"mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense"},ee={props:["medici","ruoli"],emits:["chiudiModal","utenteCreato"],data(){return{utente:{email:null,password:"password",password_confirmation:"password",username:"baluba"+Math.floor(Math.random()*100),admin:!1,attivo:!0,ruolo:null,medico_id:null}}},methods:{async creaUtente(){await axios.post("/api/sphere/sphere-user",this.utente).then(d=>{this.$emit("utenteCreato")}).catch(d=>{})}},unmounted(){this.utente={email:null,password:null,password_confirmation:null,username:null,admin:!1,attivo:!0}}},se=Object.assign(ee,{__name:"ModalNuovoUtente",setup(d){return(o,s)=>(r(),v(a(b),{as:"template",show:!0},{default:n(()=>[l(a(x),{as:"div",class:"relative z-10",onClose:s[9]||(s[9]=t=>o.$emit("chiudiModal"))},{default:n(()=>[l(a(c),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:n(()=>[C]),_:1}),e("div",M,[e("div",V,[l(a(c),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:n(()=>[l(a(h),{class:"relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-md sm:w-full sm:p-6"},{default:n(()=>[e("div",null,[e("div",z,[l(a(w),{class:"h-6 w-6 text-green-600","aria-hidden":"true"})]),e("div",j,[l(a(_),{as:"h3",class:"text-lg leading-6 font-medium text-gray-900 text-center"},{default:n(()=>[k(" Nuovo utente sphere ")]),_:1}),e("div",D,[e("div",null,[$,e("div",B,[i(e("input",{"onUpdate:modelValue":s[0]||(s[0]=t=>o.utente.email=t),type:"email",name:"email",id:"email",class:"shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md",placeholder:"you@example.com"},null,512),[[u,o.utente.email]])]),N]),e("div",null,[S,e("div",E,[i(e("input",{"onUpdate:modelValue":s[1]||(s[1]=t=>o.utente.username=t),type:"text",name:"username",id:"username",class:"shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md",placeholder:"you@example.com"},null,512),[[u,o.utente.username]])])]),e("div",null,[L,e("div",F,[i(e("input",{"onUpdate:modelValue":s[2]||(s[2]=t=>o.utente.password=t),type:"password",name:"password",id:"password",class:"shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md",placeholder:"you@example.com"},null,512),[[u,o.utente.password]])]),I]),e("div",null,[T,e("div",q,[i(e("input",{"onUpdate:modelValue":s[3]||(s[3]=t=>o.utente.password_confirmation=t),type:"password",name:"password_confirmation",id:"password_confirmation",class:"shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md",placeholder:"you@example.com"},null,512),[[u,o.utente.password_confirmation]])]),A]),e("div",G,[e("div",H,[i(e("input",{"onUpdate:modelValue":s[4]||(s[4]=t=>o.utente.attivo=t),id:"attivo",name:"attivo",type:"checkbox",class:"focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"},null,512),[[U,o.utente.attivo]])]),J]),e("div",null,[K,i(e("select",{"onUpdate:modelValue":s[5]||(s[5]=t=>o.utente.user_role_id=t),id:"ruolo",name:"ruolo",class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"},[(r(!0),m(p,null,f(d.ruoli,t=>(r(),m("option",{key:t.id,value:t.id},g(t.name),9,O))),128))],512),[[y,o.utente.user_role_id]]),P]),e("div",null,[R,i(e("select",{"onUpdate:modelValue":s[6]||(s[6]=t=>o.utente.medico_id=t),id:"medico",name:"medico",class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"},[Q,(r(!0),m(p,null,f(d.medici,t=>(r(),m("option",{key:t.id,value:t.id},g(t.ragione_sociale),9,W))),128))],512),[[y,o.utente.medico_id]]),X])])])]),e("div",Y,[e("div",Z,[e("button",{type:"button",class:"w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm",onClick:s[7]||(s[7]=t=>o.creaUtente())}," Crea utente "),e("button",{type:"button",class:"mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm",onClick:s[8]||(s[8]=t=>o.$emit("chiudiModal"))}," Chiudi ")])])]),_:1})]),_:1})])])]),_:1})]),_:1}))}});export{se as default};
