            <style>
                #checktable tr{height:42px; text-align:center;font-size:21px;}
                #checktable input{width:100%;height:45px;border:0px solid red;padding:0px;text-indent:7px;}
                #checktable_tj{margin:30px auto;float:right;margin-right: 230px;width:100px;height:50px;font-size:24px;}
            </style>
            <form action='/admin/project/{{$checkTable->id}}/update/checktable' method='POST'>
                <table id="checktable" border=1 align="center" max-width=1900px>
                    <tr>
                        <td width=42px rowspan=5>外委队伍概况</td>
                        <td width=210px>企业名称(外委)</td>
                        <td colspan=3><input type="text" name="company_name" value="{{$checkTable->company_name}}" style="height:42px;"></td>
                        <td width=240px>企业性质</td>
                        <td><input type="text" name="company_type" value="{{$checkTable->company_type}}"></td>
                    </tr>
                    <tr>
                        <td>企业地址</td>
                        <td colspan=3><input type="text" name="company_addr" value="{{$checkTable->company_addr}}"></td>
                        <td>法人(实际控制人)</td>
                        <td><input type="text" name="legal_person" value="{{$checkTable->legal_person}}"></td>
                    </tr>
                    <tr>
                        <td>项目(作业)负责人</td>
                        <td width=200px><input type="text" name="project_leader" value="{{$checkTable->project_leader}}"></td>
                        <td width=170px>职务</td>
                        <td width=200px><input type="text" name="project_leader_duty" value="{{$checkTable->project_leader_duty}}"></td>
                        <td width=250px>联系电话</td>
                        <td><input type="text" name="project_leader_tel" value="{{$checkTable->project_leader_tel}}"></td>
                    </tr>
                    <tr>
                        <td>安全管理负责人</td>
                        <td><input type="text" name="safety_leader" value="{{$checkTable->safety_leader}}"></td>
                        <td>职务</td>
                        <td><input type="text" name="safety_leader_duty" value="{{$checkTable->safety_leader_duty}}"></td>
                        <td>联系电话</td>
                        <td><input type="text" name="safety_leader_tel" value="{{$checkTable->safety_leader_tel}}"></td>
                    </tr>
                    <tr>
                        <td>施工(作业)人数</td>
                        <td><input type="text" name="worker_count" value="{{$checkTable->worker_count}}" style="height:65px;"></td>
                        <td>专职安全生<br>产管理人员</td>
                        <td><input type="text" name="safe_worker" value="{{$checkTable->safe_worker}}" style="height:65px;"></td>
                        <td>特种作业人数</td>
                        <td><input type="text" name="special_workers" value="{{$checkTable->special_workers}}" style="height:65px;"></td>
                    </tr>

                    <tr>
                        <td style="height:170px;" rowspan=3>发包方管理</td>
                        <td>发包部门</td>
                        <td><input type="text" name="department" value="{{$checkTable->department}}"></td>
                        <td>负责人</td>
                        <td><input type="text" name="department_project_leader" value="{{$checkTable->department_project_leader}}"></td>
                        <td>联系电话</td>
                        <td><input type="text" name="department_project_leader_tel" value="{{$checkTable->department_project_leader_tel}}"></td>
                    </tr>
                    <tr>
                        <td>项目(作业)区域单位</td>
                        <td><input type="text" name="job_location" value="{{$checkTable->job_location}}"></td>
                        <td>负责人</td>
                        <td><input type="text" name="job_location_leader" value="{{$checkTable->job_location_leader}}"></td>
                        <td>联系电话</td>
                        <td><input type="text" name="location_leader_tel" value="{{$checkTable->location_leader_tel}}"></td>
                    </tr>
                    <tr>
                        <td>区域单位现场<br>管理负责人</td>
                        <td><input type="text" name="field_leader" value="{{$checkTable->field_leader}}" style="height:67px;"></td>
                        <td>联系电话</td>
                        <td><input type="text" name="field_leader_tel" value="{{$checkTable->field_leader_tel}}" style="height:67px;"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="height:170px;">
                        <td style="width:27px;">工程简介</td>
                        <td colspan=6><textarea name="introduction" style="width:100%;height:250px;border:0px solid red;float:left;">{{$checkTable->introduction}}</textarea></td>
                    </tr>
                    <tr style="height:170px;">
                        <td>审核意见</td>
                        <td colspan=3 valign=top style="text-align:left;position: relative;" >审核人意见
                            <a href="" style="position: absolute;left:40%;top:47%;">点击审核</a>
                        </td>
                        <td colspan=3 valign=top style="text-align:left;position: relative;" >审核部门领导意见
                            <a href="" style="position: absolute;left:40%;top:47%;">点击审核</a>
                        </td>
                    </tr>
                </table>
                    {{csrf_field()}}
                <input type="submit" class="btn btn-primary" id="checktable_tj" value="保存">
            </form>