      <div class ='ui segments' style ='margin:10px'>
        @if (isset($insidethelab))
          <div class ='ui blue inverted segment headitem'>
        @else
          <div  class ='ui segment headitem'>
        @endif
          <a class='subitem' value ='1'href ='/dashboard/'>Show students inside the lab</a>
        </div>
          @if (!empty($role))
            @if (isset($allstudents))
              <div  class ='ui blue inverted segment headitem'>
            @else
              <div class ='ui segment headitem'>
            @endif
            <a class='subitem' value ='2' href ='/dashboard/allstudents'>Show all students</a>
              </div>
            @if (isset($labsched))
              <div  class ='ui blue inverted segment headitem'>
            @else
              <div class ='ui segment headitem'>
            @endif
                <a class='subitem' value ='3' href ='/dashboard/labsched'>Laboratory schedules</a>
              </div>
            @if(isset($laboratories))
              <div  class ='ui blue inverted segment headitem'>
            @else
              <div class ='ui segment headitem'>
            @endif
              <a class='subitem' value ='3' href ='/dashboard/laboratories'>Laboratories</a>
              </div>
            @if(isset($accounts))
              <div class ='ui blue inverted segment headitem'>
            @else
              <div class ='ui segment headitem'>
            @endif
                <a class='subitem' value ='3' href ='/dashboard/accounts'>Accounts</a>
              </div>
          @endif
            </div>