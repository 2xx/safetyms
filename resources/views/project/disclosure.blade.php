            <style>
                #disclosure tr{height:42px; text-align:center;font-size:21px;}
                #disclosure input{width:100%;height:60px;border:0px solid red;padding:0px;text-indent:7px;}
                #safety_content{width:100%;height:400px;float:left;}
                #content{width:100%;height:400px;float:left;}
                #disclosure_tj{margin:30px auto;float:right;margin-right: 230px;width:100px;height:50px;font-size:24px;}
            </style>
            <form action='/admin/project/{{$disclosure->id}}/update/disclosure' method='POST'>
                <table id="disclosure" border=1 align="center" max-width=2900px>
                    <tr>
                       <td style="width:70px;">外委<br>单位</td>
                       <td style="width:200px;"><input type="text" name="department_name" value="{{$disclosure->department_name}}"></td>
                       <td>主管<br>领导</td>
                       <td colspan="2"><input type="text" name="department_leader" value="{{$disclosure->department_leader}}"></td>
                       <td>负责人</td>
                       <td style="width:100px;"><input type="text" name="charge" value="{{$disclosure->charge}}"></td>
                       <td style="width:170px;">工程项目</td>
                       <td colspan="2"><input type="text" name="project_name" value="{{$disclosure->project_name}}"></td>
                    </tr>
                    <tr>
                        <td>施工<br>单位</td>
                        <td><input type="text" name="company_name" value="{{$disclosure->company_name}}"></td>
                        <td>法人代表</td>
                        <td style="width:100px;"><input type="text" name="legal_person" value="{{$disclosure->legal_person}}"></td>
                        <td>负责人</td>
                        <td style="width:100px;"><input type="text" name="company_duty" value="{{$disclosure->company_duty}}"></td>
                        <td>时间</td>
                        <td>
                            <input type="text" name="job_time" value="">
                        </td>
                        <td>施工地点</td>
                        <td style="width:150px;"><input type="text" name="project_addr" value="{{$disclosure->project_addr}}"></td>
                    </tr>
                    <tr style="height:400px;">
                       <td>
                            <div>安</div>
                            <div>全</div>
                            <div>交</div>
                            <div>底</div>
                            <div>内</div>
                            <div>容</div>
                       </td>
                       <td colspan="9"><textarea id="safety_content"  name="safety_content">{{$disclosure->safety_content}}</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="10" style="height:300px;"><textarea id="content" name="content">{{$disclosure->content}}</textarea></td>
                    </tr>
                   <tr>
                        <td>区域<br>单位</td>
                        <td colspan="2"><input type="text" name="field_name" value="{{$disclosure->field_name}}"></td>
                        <td>主管<br>领导</td>
                        <td colspan="2" style="position: relative;">
                            @if($disclosure->manager_sign==0)
                                @if($disclosure->manager_name==Admin::user()->id)
                                 <a href="/admin/disclosure/{{$disclosure->id}}/manager_name/sign" style="position: absolute;left:18%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:18%;top:30%;">等待{{$disclosure->manager_name_str}}审核</span>
                                @endif
                            @elseif($disclosure->manager_sign==1)
                               <span style="position: absolute;left:1%;top:30%;">已由{{$disclosure->manager_name_str}}审核</span>
                            @endif
                        </td>
                        <td>车间<br>主任</td>
                        <td style="position: relative;">
                            @if($disclosure->workshop_sign==0)
                                @if($disclosure->workshop_leader==Admin::user()->id)
                                 <a href="/admin/disclosure/{{$disclosure->id}}/workshop_leader/sign" style="position: absolute;left:18%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:0%;top:9%;">等待{{$disclosure->workshop_leader_str}}审核</span>
                                @endif
                            @elseif($disclosure->workshop_sign==1)
                               <span style="position: absolute;left:0%;top:9%;">已由{{$disclosure->workshop_leader_str}}审核</span>
                            @endif
                        </td>
                        <td>设备科长</td>
                        <td style="position: relative;">
                            @if($disclosure->device_sign==0)
                                @if($disclosure->device_leader==Admin::user()->id)
                                 <a href="/admin/disclosure/{{$disclosure->id}}/device_leader/sign" style="position: absolute;left:8%;top:30%;">点击审核</a>
                                @else
                                 <span style="position: absolute;left:2%;top:8%;">等待{{$disclosure->device_leader_str}}审核</span>
                                @endif
                            @elseif($disclosure->device_sign==1)
                               <span style="position: absolute;left:2%;top:8%;">已由{{$disclosure->device_leader_str}}审核</span>
                            @endif
                        </td>
                   </tr>
                </table>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary"  id="disclosure_tj" value="保存">
            </form>