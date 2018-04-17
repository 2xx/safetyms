            <style>
                #safetycard tr{height:42px; text-align:center;font-size:21px;}
                #safetycard input{width:100%;height:67px;border:0px solid red;padding:0px;text-indent:7px;}
                #safetycard_tj{margin:30px auto;float:right;margin-right: 230px;width:100px;height:50px;font-size:24px;}
                #safetycard textarea{width:100%;height:500px;float:left;}
            </style>
            <form action='/admin/project/{{$safetyCard->id}}/update/safetycard' method='POST'>
                <table id="safetycard" border=1 align="center" max-width=1900px>
                    <tr>
                       <td style="width:100px;">外委<br>单位</td>
                       <td style="width:180px;"><input type="text" name="department_name" value="{{$safetyCard->department_name}}"></td>
                       <td style="width:120px;">主管领导<br>签字</td>
                       <td colspan="2"><input type="text" name="department_leader" value="{{$safetyCard->department_leader}}"></td>
                       <td style="width:120px;">负责人</td>
                       <td style="width:100px;"><input type="text" name="charge" value="{{$safetyCard->charge}}"></td>
                       <td style="width:170px;">工程项目</td>
                       <td colspan="2" style="width:150px;"><input type="text" name="project_name" value="{{$safetyCard->project_name}}"></td>
                    </tr>
                    <tr>
                        <td>外来<br>单位</td>
                        <td><input type="text" name="company_name" value="{{$safetyCard->company_name}}"></td>
                        <td>法人代表</td>
                        <td style="width:120px;"><input type="text" name="legal_person" value="{{$safetyCard->legal_person}}"></td>
                        <td>责任人</td>
                        <td><input type="text" name="company_duty" value="{{$safetyCard->company_duty}}"></td>
                        <td>时间</td>
                        <td style="width:100px;"><input type="text" name="job_time" value="{{$safetyCard->job_time}}"></td>
                        <td style="width:100px;">地点</td>
                        <td style="width:170px;"><input type="text" name="project_addr" value="{{$safetyCard->project_addr}}"></td>
                    </tr>
                    <tr style="height:400px;">
                       <td colspan="10"><textarea  name="content">{{$safetyCard->content}}</textarea></td>
                    </tr>
                    <tr>
                        <td>区域<br>单位</td>
                        <td><input type="text" name="field_name" value="{{$safetyCard->field_name}}"></td>
                        <td>主管领导<br>签字</td>
                        <td style="position:relative;">
                            @if($safetyCard->manager_sign==0)
                                @if($safetyCard->manager_name==Admin::user()->id)
                                 <a href="/admin/safetycard/{{$safetyCard->id}}/manager_name/sign" style="position: absolute;left:7%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:7%;top:17%;">待<strong style="color:blue;font-weight: normal;">{{$safetyCard->manager_name_str}}</strong>审核</span>
                                @endif
                            @elseif($safetyCard->manager_sign==1)
                               <span style="position: absolute;left:7%;top:5%;">已由{{$safetyCard->manager_name_str}}审核</span>
                            @endif
                        </td>
                        <td>车间主任<br>签字</td>
                        <td style="position:relative;">
                            @if($safetyCard->workshop_sign==0)
                                @if($safetyCard->workshop_leader==Admin::user()->id)
                                 <a href="/admin/safetycard/{{$safetyCard->id}}/workshop_leader/sign" style="position: absolute;left:7%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:7%;top:30%;">待<strong style="color:blue;font-weight: normal;">{{$safetyCard->workshop_leader_name}}</strong>审核</span>
                                @endif
                            @elseif($safetyCard->workshop_sign==1)
                               <span style="position: absolute;left:7%;top:5%;">已由{{$safetyCard->workshop_leader_name}}审核</span>
                            @endif
                        </td>
                        <td>安全科<br>签字</td>
                        <td style="position:relative;">
                            @if($safetyCard->section_sign==0)
                                @if($safetyCard->safety_section==Admin::user()->id)
                                 <a href="/admin/safetycard/{{$safetyCard->id}}/safety_section/sign" style="position: absolute;left:15%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:15%;top:30%;">待<strong style="color:blue;font-weight: normal;">{{$safetyCard->safety_section_name}}</strong>审核</span>
                                @endif
                            @elseif($safetyCard->section_sign==1)
                               <span style="position: absolute;left:1%;top:12%;">已由{{$safetyCard->safety_section_name}}审核</span>
                            @endif
                        </td>
                        <td>安全部<br>签字</td>
                        <td style="position:relative;">
                            @if($safetyCard->department_sign==0)
                                @if($safetyCard->safety_department==Admin::user()->id)
                                 <a href="/admin/safetycard/{{$safetyCard->id}}/safety_department/sign" style="position: absolute;left:15%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:15%;top:30%;">待<strong style="color:blue;font-weight: normal;">{{$safetyCard->safety_department_name}}</strong>审核</span>
                                @endif
                            @elseif($safetyCard->department_sign==1)
                               <span style="position: absolute;left:1%;top:12%;">已由{{$safetyCard->safety_department_name}}审核</span>
                            @endif
                        </td>
                    </tr>
                   
                </table>
                   {{csrf_field()}}
                <input type="submit" class="btn btn-primary" id="safetycard_tj" value="保存">
            </form>