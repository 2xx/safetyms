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
                        <td><input type="text" name="manager_name" value="{{$safetyCard->manager_name}}"></td>
                        <td>车间主任<br>签字</td>
                        <td><input type="text" name="workshop_leader" value="{{$safetyCard->workshop_leader}}"></td>
                        <td>安全科<br>签字</td>
                        <td><input type="text" name="safety_section" value="{{$safetyCard->safety_section}}"></td>
                        <td>安全部<br>签字</td>
                        <td><input type="text" name="safety_department" value="{{$safetyCard->safety_department}}"></td>
                    </tr>
                   
                </table>
                   {{csrf_field()}}
                <input type="submit" class="btn btn-primary" id="safetycard_tj" value="保存">
            </form>