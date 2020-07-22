
package com.cristian.dayclass;
import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

@Entity
@Table(name="alumno", schema="dayclass")
public class CodigoAsistencia implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHoraFinCodigo;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHoraInicioCodigo;
    private int numCodigo; 
     @ManyToOne
    private Curso curso; 

    public CodigoAsistencia() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public Date getFechaHoraFinCodigo() {
        return fechaHoraFinCodigo;
    }

    public Date getFechaHoraInicioCodigo() {
        return fechaHoraInicioCodigo;
    }

    public int getNumCodigo() {
        return numCodigo;
    }

    public Curso getCurso() {
        return curso;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setFechaHoraFinCodigo(Date fechaHoraFinCodigo) {
        this.fechaHoraFinCodigo = fechaHoraFinCodigo;
    }

    public void setFechaHoraInicioCodigo(Date fechaHoraInicioCodigo) {
        this.fechaHoraInicioCodigo = fechaHoraInicioCodigo;
    }

    public void setNumCodigo(int numCodigo) {
        this.numCodigo = numCodigo;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }
     
    
}
