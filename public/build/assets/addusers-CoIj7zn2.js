import{T as m,c as u,a as d,u as t,w as i,F as p,o as f,Z as w,b as s,f as b,j as l,D as a,k as v}from"./app-Bshtgp-Q.js";import{A as x}from"./AuthenticatedLayout-PWHvvRgb.js";import"./ApplicationLogo-C-oCVjLM.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const y={class:"max-w-lg mx-auto mt-8 p-6 bg-white rounded shadow-md"},g={class:"mb-4"},U={class:"mb-4"},k={class:"mb-4"},V={class:"mb-4"},A={class:"mb-4"},M={__name:"addusers",setup(q){const e=m({name:"",email:"",password:"",password_confirmation:"",role:"user"});function n(){if(e.password!==e.password_confirmation){alert("Passwords do not match!");return}e.post("/addusers")}return(N,o)=>(f(),u(p,null,[d(t(w),{title:"Add User"}),d(x,null,{header:i(()=>o[5]||(o[5]=[s("h1",{class:"text-2xl font-bold text-center text-gray-700"},"Add New User",-1)])),default:i(()=>[s("div",y,[s("form",{onSubmit:b(n,["prevent"])},[s("div",g,[o[6]||(o[6]=s("label",{for:"name",class:"block text-gray-700"},"Name:",-1)),l(s("input",{"onUpdate:modelValue":o[0]||(o[0]=r=>t(e).name=r),type:"text",id:"name",class:"w-full p-2 mt-1 border rounded",required:""},null,512),[[a,t(e).name]])]),s("div",U,[o[7]||(o[7]=s("label",{for:"email",class:"block text-gray-700"},"Email:",-1)),l(s("input",{"onUpdate:modelValue":o[1]||(o[1]=r=>t(e).email=r),type:"email",id:"email",class:"w-full p-2 mt-1 border rounded",required:""},null,512),[[a,t(e).email]])]),s("div",k,[o[8]||(o[8]=s("label",{for:"password",class:"block text-gray-700"},"Password:",-1)),l(s("input",{"onUpdate:modelValue":o[2]||(o[2]=r=>t(e).password=r),type:"password",id:"password",class:"w-full p-2 mt-1 border rounded",required:""},null,512),[[a,t(e).password]])]),s("div",V,[o[9]||(o[9]=s("label",{for:"password_confirmation",class:"block text-gray-700"},"Confirm Password:",-1)),l(s("input",{"onUpdate:modelValue":o[3]||(o[3]=r=>t(e).password_confirmation=r),type:"password",id:"password_confirmation",name:"password_confirmation",class:"w-full p-2 mt-1 border rounded",required:""},null,512),[[a,t(e).password_confirmation]])]),s("div",A,[o[11]||(o[11]=s("label",{for:"role",class:"block text-gray-700"},"Role:",-1)),l(s("select",{"onUpdate:modelValue":o[4]||(o[4]=r=>t(e).role=r),id:"role",class:"w-full p-2 mt-1 border rounded"},o[10]||(o[10]=[s("option",{value:"user"},"User",-1),s("option",{value:"staff"},"Staff",-1),s("option",{value:"supervisor"},"Supervisor",-1),s("option",{value:"admin"},"Admin",-1)]),512),[[v,t(e).role]])]),o[12]||(o[12]=s("button",{type:"submit",class:"w-full p-2 mt-4 bg-blue-500 text-white rounded hover:bg-blue-600"}," Add User ",-1))],32)])]),_:1})],64))}};export{M as default};
